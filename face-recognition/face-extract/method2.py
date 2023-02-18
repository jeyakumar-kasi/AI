# -*- coding: utf-8 -*-
"""
Created on Tue Nov  8 19:45:36 2022

@author: JeyakumarKasi
"""

import dlib
from skimage import io
import face_recognition
import cv2


#filepath = '../images/test/Arkamita7.jpeg'
filepath = '../images/test/Rudra deb Bose (4).jpg'
print("Reading the image...")

# face_detector = dlib.get_frontal_face_detector()
# win = dlib.image_window()

# img_data = io.imread(filepath)
# detected_faces = face_detector(img_data, 1)
# print("I found {} faces in the file {}".format(len(detected_faces), filepath))

# win.set_image(img_data)

# for i, face in enumerate(detected_faces):
#     print("- Face #{} found at Left: {} Top: {} Right: {} Bottom: {}".format(i, face.left(), face.top(), face.right(), face.bottom()))
#     win.add_overlay(face)
    
# dlib.hit_enter_to_continue()

# ------------------------

# import cv2


# img_data = face_recognition.load_image_file(filepath)
# img_data = cv2.cvtColor(img_data, cv2.COLOR_BGR2RGB)
# face = face_recognition.face_locations(img_data)[0]
# print(face)
# copy = img_data.copy()
# #-------------------Drawing the Rectangle-------------------------
# cv2.rectangle(copy, (face[3], face[0]),(face[1], face[2]), (255,0,255), 2)
# cv2.imshow('copy', copy)
# cv2.imshow('elon',img_data)
# cv2.waitKey(0)

    

# --------------------------

# from skimage.feature import hog
# from skimage import exposure
# import cv2
# import matplotlib.pyplot as plt


# image = cv2.imread('../images/test/Arkamita7.jpeg')
# fd, hog_image = hog(image, orientations=8, pixels_per_cell=(16, 16),
#                     cells_per_block=(1, 1), visualize=True, multichannel=True)

# fig, (ax1, ax2) = plt.subplots(1, 2, figsize=(8, 4), sharex=True, sharey=True)

# ax1.axis('off')
# ax1.imshow(image, cmap=plt.cm.gray)
# ax1.set_title('Input image')

# # Rescale histogram for better display
# hog_image_rescaled = exposure.rescale_intensity(hog_image, in_range=(0, 10))

# ax2.axis('off')
# ax2.imshow(hog_image_rescaled, cmap=plt.cm.gray)
# ax2.set_title('Histogram of Oriented Gradients')
# plt.show()


# --------------------------------------------

# function for face detection with mtcnn
from PIL import Image
from numpy import asarray
from mtcnn.mtcnn import MTCNN

# extract a single face from a given photograph
def extract_face(filename, required_size=(160, 160)):
    # load image from file
    image = Image.open(filename)
    # convert to RGB, if needed
    image = image.convert('RGB')
    # convert to array
    pixels = asarray(image)
    # create the detector, using default weights
    detector = MTCNN()
    # detect faces in the image
    results = detector.detect_faces(pixels)
    
    # win = dlib.image_window()
    # win.set_image(image)
    for i, face in enumerate(results):
        x1, y1, width, height = face['box']
        print("- Face #{} found at Left: {} Top: {} Right: {} Bottom: {}".format(i, x1, y1, x1+width, y1+height))
        
        #-------------------Drawing the Rectangle-------------------------
        # bug fix
        x1, y1 = abs(x1), abs(y1)
        x2, y2 = x1 + width, y1 + height
        
        # extract the face
        face = pixels[y1:y2, x1:x2]
        # resize pixels to the model size
        image = Image.fromarray(face)
        image = image.resize(required_size)
        face_array = asarray(image)
        
        #cv2.rectangle(face_array, (x1, y1),(x2, y2), (255,0,255), 2)
        cv2.imshow('elon',face_array)
        cv2.waitKey(0)
   
        #win.add_overlay(face)
        
    #dlib.hit_enter_to_continue()    
    
    # extract the bounding box from the first face
#     x1, y1, width, height = results[0]['box']
#     # bug fix
#     x1, y1 = abs(x1), abs(y1)
#     x2, y2 = x1 + width, y1 + height
#     # extract the face
#     face = pixels[y1:y2, x1:x2]
#     # resize pixels to the model size
#     image = Image.fromarray(face)
#     image = image.resize(required_size)
#     face_array = asarray(image)
#     return face_array

# load the photo and extract the face
filepath = r'C:\works\datafoundry\face-recognition\images\people\Debjit Biswas\Debjit_6.jpeg'
pixels = extract_face(filepath)
# print(pixels)




    
    






