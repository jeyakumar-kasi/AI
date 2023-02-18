# -*- coding: utf-8 -*-
"""
Created on Fri Nov  4 00:25:35 2022

@author: JeyakumarKasi
"""
import os
import cv2
import pickle 
import numpy as np
from PIL import Image

from keras_vggface import utils
from tensorflow.keras.preprocessing import image
from tensorflow.keras.models import load_model

face_test_img_dir = './images/test'
filter_img_ext = ('.jpg', '.png', '.jpeg')
CROP_IMG_SIZE = (224, 224) # Cropped face img - Width & Height
class_labels_filepath = './model/model_class_labels.pkl'
train_model_filepath = './model/trained_face_cnn_model.h5'
faceCascade = cv2.CascadeClassifier('./haarcascade_frontalface_default.xml')

class_labels_filepath = os.path.abspath(class_labels_filepath)
train_model_filepath = os.path.abspath(train_model_filepath)

# Load the classified Persons list
print(f'Loading the list of class labels <{class_labels_filepath}> ...')
with open(class_labels_filepath, 'rb') as fh:
    person_classes = pickle.load(fh)
    
# Load the model
print(f'Loading the trained model <{train_model_filepath}> ...')
model = load_model(train_model_filepath)
    
for root_dir, dirs, files in os.walk(face_test_img_dir):
    for file in files:
        if os.path.splitext(file)[1] in filter_img_ext:
            filepath = os.path.abspath(os.path.join(root_dir, file))
            
            img = cv2.imread(filepath, cv2.IMREAD_COLOR)
            img_array = np.array(img, "uint8")
            
            # Detect the faces
            faces = faceCascade.detectMultiScale(img_array, scaleFactor=1.1, minNeighbors=5)
            if len(faces) != 1:
                # If no faces or two or more faces detected (i.e Group Photo) then skip it.
                if len(faces) == 0:
                    print(f'WARN: <{file}> No face is detected.')
                else:
                    print(f'WARN: <{file}> {len(faces)} Face(s) are detected. Considering as a Group photo. Skipped.')
                #! os.remove(filepath)
                continue
            
            print(f"INFO: Predicting ... <{file}>")
            for (x, y, w, h) in faces:
                detected_img = cv2.rectangle(img, (x, y), (x+w, y+h), (255, 0, 255), 2)
                
                # Crop & Resize
                crop_img = img_array[y: y+h, x: x+w]
                resized_img = cv2.resize(crop_img, CROP_IMG_SIZE)
                
                # Prepare the image for prediction
                x = image.img_to_array(resized_img)
                x = np.expand_dims(x, axis=0)
                x = utils.preprocess_input(x, version=1)
                
                predicted_prob = model.predict(x)
                # print(predicted_prob)
                pred_person_id = predicted_prob[0].argmax()
                print(f"Predicted Person ID: {pred_person_id} Name: {person_classes[pred_person_id]}")
            
            
            
            