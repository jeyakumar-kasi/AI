# -*- coding: utf-8 -*-
"""
Created on Thu Nov  3 19:00:17 2022

@author: JeyakumarKasi
"""

import cv2


faceCascade = cv2.CascadeClassifier('./haarcascade_frontalface_default.xml')


def detect_faces(frame, is_crop=False):
    frame_rgb = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
    faces = faceCascade.detectMultiScale(frame_rgb, scaleFactor=1.3, minNeighbors=5)
    for (x, y, w, h) in faces:
        # Draw rectangle
        color = (0, 0, 255)
        stroke = 5
        cv2.rectangle(frame, (x, y), (x+w, y+h), color, stroke)
    return frame


stream = cv2.VideoCapture(0)
while True:
    # Capture frame by frame
    grabbed, frame = stream.read()
    
    frame = detect_faces(frame)
        
    # Show Image
    cv2.imshow('window1', frame)
    
    press_key = cv2.waitKey(1) & 0xFF
    if press_key == ord('q'):
        break
        
# Clean up
stream.release()
cv2.waitKey(1)
cv2.destroyAllWindows()
cv2.waitKey(1)


    

        
    
    

