# -*- coding: utf-8 -*-
"""
Created on Tue Nov  8 11:20:31 2022

@author: JeyakumarKasi
"""

import cv2
import face_recognition


filepath = '../images/test/Arkamita6.jpeg'
print("Reading the image...")
img_data = cv2.imread(filepath)
rgb = cv2.cvtColor(img_data, cv2.COLOR_BGR2RGB)
print("Detecting the faces...")
faces = face_recognition.face_locations(rgb, model='cnn')
print("Done.")
print(faces)

