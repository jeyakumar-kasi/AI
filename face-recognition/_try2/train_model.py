# -*- coding: utf-8 -*-
"""
Created on Thu Nov  3 20:56:00 2022

@author: JeyakumarKasi
"""

import os
import cv2
import shutil
import numpy as np
from PIL import Image
import matplotlib.pyplot as plt
from helpers import extract_faces

import logging
logging.basicConfig(filename='./logs.txt', filemode='w', level=logging.WARNING)

img_dir = '../images/people'
crop_dir = '../images/faces'
challenge_dir = '../images/challenge'
CROP_IMG_SIZE = (224, 224) # Cropped face img - Width & Height
filter_img_ext = ('.jpg', '.png', '.jpeg')

persons = {}
person_id = 0
face_img_count = 0
for root_dir, dirs, files in os.walk(img_dir):
    for file in files:
        if os.path.splitext(file)[1] in filter_img_ext:
            filepath = os.path.abspath(os.path.join(root_dir, file))
            
            # Get the Person Name from the folder path.
            person_name = os.path.basename(root_dir).replace(' ', '_').lower()
            if person_name not in persons:
                person_id += 1
                persons[person_name] = person_id
                
            # Detect the faces
            img_arr, faces =  extract_faces(filepath, CROP_IMG_SIZE)
            if len(faces) != 1:
                # If no faces or two or more faces detected (i.e Group Photo) then skip it.
                if len(faces) == 0:
                    msg = f'WARN: <{person_name}: {file}> No face is detected.'
                    print(msg)
                    logging.warning(msg)
                    shutil.copyfile(filepath, os.path.join(challenge_dir, file))
                else:
                    msg = f'WARN: <{person_name}: {file}> {len(faces)} Face(s) are detected. Considering as a Group photo. Skipped.'
                    print(msg)
                    logging.warning(msg)
                    shutil.copyfile(filepath, os.path.join(challenge_dir, 'group', str(len(faces)) + '_' + file))
                #! os.remove(filepath)
                continue
            
            print(f"INFO: <{person_name}: {file}> Processing...")
            for (x, y, w, h) in faces:
                x1, y1 = abs(x), abs(y)
                x2, y2 = x1 + w, y1 + h
                
                # detected_img = cv2.rectangle(img_arr, (x1, y1), (x2, y2), (255, 0, 255), 2)
                # plt.imshow(detected_img)
                # plt.show()
                
                # Crop the face
                crop_img = img_arr[y1: y2, x1: x2]
                
                # Resize the image
                resized_img = cv2.resize(crop_img, CROP_IMG_SIZE)
                img_arr = np.array(resized_img, "uint8")
                
                # Drop the orignal image
                #! os.remove(filepath)
                
                # Create the face image and save it.
                face_img = Image.fromarray(img_arr)
                face_img_dir = os.path.join(crop_dir, person_name)
                os.makedirs(face_img_dir, exist_ok=True)
                face_img.save(os.path.join(face_img_dir, file))
                face_img_count += 1
                
exit(0)                

# Populate the training data 
# -----------------------------------------------------------------------------
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from tensorflow.keras.applications.mobilenet import preprocess_input

# Generate dump image data
train_datagen = ImageDataGenerator(preprocessing_function=preprocess_input)
train_generator = train_datagen.flow_from_directory(
    crop_dir, 
    target_size=CROP_IMG_SIZE, 
    color_mode='rgb',
    batch_size=32,
    class_mode='categorical',
    shuffle=True
)
                
# Detected number of classes.
no_of_classes = len(train_generator.class_indices.values())
print(no_of_classes)


# Build the Model
# -----------------------------------------------------------------------------
from keras_vggface.vggface import VGGFace
input_shape = CROP_IMG_SIZE + (3, ) # Crop Size + RGB color representation.
print(input_shape)

# Get the total layers found. (i.e include_top = True)
#! base_model = VGGFace(include_top=True, model='vgg16', input_shape=input_shape)
#! total_layers = len(base_model.layers)

# Get the most important "fully connected" layers (i.e include_top = False)
base_model = VGGFace(include_top=False, model='vgg16', input_shape=input_shape)
total_fully_connected_layers = len(base_model.layers)
print(base_model.summary())

# Add the custom layers
from tensorflow.keras.layers import Dense, GlobalAveragePooling2D
x = base_model.output
x = GlobalAveragePooling2D()(x)

x = Dense(1024, activation='relu', name='custom_1024_1')(x)
x = Dense(1024, activation='relu', name='custom_1024_2')(x)
x = Dense(512, activation='relu', name='custom_512_1')(x)

print(base_model.summary())

# Add the FINAL Layer with Softmax activation
print(persons)
print(f'No. of Classes: {no_of_classes} | Fully connected Layers: {total_fully_connected_layers}')
preds = Dense(no_of_classes, activation='softmax')(x)


from tensorflow.keras.models import Model
#! model = VGGFace(model='vgg16') # vgg16, resnet50, senet50 => Downloaded into: ~/.keras/models/
model = Model(base_model.input, preds, name='CustomVGGFaceModel')
# Don't train already Fully connected layers. Because of they are already trained.
for layer in model.layers[:total_fully_connected_layers]:
    layer.trainable = False

# Set all other custom added layers as trainable.
for layer in model.layers[total_fully_connected_layers:]:
    layer.trainable = True 
    


# Compile & train the model
# -----------------------------------------------------------------------------
train_model_filepath = './model/trained_face_cnn_model.h5' # HDF5 file.
model.compile(optimizer='Adam', loss='categorical_crossentropy', metrics=['accuracy'])
model.fit(train_generator, batch_size=1, verbose=1, epochs=20)
print(f'Saving the trained model into <{train_model_filepath}> ...')
model.save(train_model_filepath) 


# Verify the model after saving.
from tensorflow.keras.models import load_model

del model
model = load_model(train_model_filepath)

# Save the persons (Labels)
import pickle
person_classes = {person_id: person_name for person_name, person_id in train_generator.class_indices.items()}
class_labels_filepath = './model/model_class_labels.pkl'
with open(class_labels_filepath, 'wb') as fh:
    print(f'Saving the classied label/person names into <{class_labels_filepath}>...')
    pickle.dump(person_classes, fh)
print(person_classes)
    





            
            
            



