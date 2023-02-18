# -*- coding: utf-8 -*-
"""
Created on Tue Nov  8 20:45:25 2022

@author: JeyakumarKasi
"""


import numpy as np
from PIL import Image
from mtcnn.mtcnn import MTCNN 

import os
import cv2
import matplotlib.pyplot as plt


def write_face(img_arr, filepath='./face.jpg', size=255):
    # plt.imshow(img_arr)
    # plt.show()
    
    img_arr *= 255
    print(f"Writing the image <{filepath}>...")
    cv2.imwrite(filepath, img_arr[:, :, ::-1])
    return filepath


def detect1(filepath, crop_size=(244, 244)):
    face_detector = MTCNN()
    img_data = Image.open(filepath).convert('RGB')
    pixels = np.asarray(img_data)
    faces = face_detector.detect_faces(pixels)
    return pixels, [face['box'] for face in faces]


from deepface import DeepFace
def detect(filepath, detector_idx=0, attempt=1):
    detectors = ['mtcnn', 'retinaface', 'opencv', 'ssd', 'dlib']
    try:
        img = DeepFace.detectFace(filepath, detector_backend=detectors[detector_idx])
    except ValueError as e:
        if 'Face could not be detected' in str(e):
            detector_idx += 1
            if attempt == 1:
                if detector_idx >= len(detectors):
                    # If it is the last detector, then switch to the first one in the list.
                    detector_idx = 0
                print(f"Trying with <{detectors[detector_idx]}>...")
            elif attempt >= len(detectors):
                return False
            return detect(filepath, detector_idx=detector_idx, attempt=attempt)
    return img, detectors[detector_idx]



if __name__ == '__main__':
    filter_img_ext = ('.jpg', '.png', '.jpeg')
    img_dir = r'C:\works\datafoundry\face-recognition\images\challenge'
    for root_dir, dirs, files in os.walk(img_dir):
        for file in files:
            if os.path.splitext(file)[1] in filter_img_ext:
                # filepath = r'C:\works\datafoundry\face-recognition\images\challenge\Debjit_3.jpeg'
                filepath = os.path.abspath(os.path.join(root_dir, file))
                img_arr, detector_name = detect(filepath)
                
                filename, ext = os.path.splitext(os.path.basename(filepath))
                dest_filepath = './faces/' + filename + '_' + str(detector_name) + ext 
                write_face(img_arr, dest_filepath)