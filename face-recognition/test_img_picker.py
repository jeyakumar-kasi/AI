# -*- coding: utf-8 -*-
"""
Created on Mon Nov  7 21:51:26 2022

@author: JeyakumarKasi
"""

import os
import random

img_dir = './images/people'
dest_dir = './images/test'

count = 0
move_files_list = []
for root_dir, dirs, files in os.walk(img_dir):
    for file in files:
        print(file)
            
    
    # for root_dir, dirs, files in os.walk(img_dir):
    # print(len(files))
    # for file in files:
    #     print(file)
    
    if random.randint(0, 1) == 0 \
    or random.randint(0, 1) == 0 \
    or random.randint(0, 1) == 0 \
    or random.randint(0, 1) == 0 \
    or random.randint(0, 1) == 0:
        continue    
    
    total_files = len(files)
    print(total_files)
    if total_files > 0:
        for i in range(random.randint(1, 3)):
            _id = random.randint(1, total_files)
            filename = files[_id-1]
            filepath = os.path.abspath(os.path.join(root_dir, filename))
            dest_path = os.path.join(dest_dir, filename)
            print(f'Adding {filepath}...')
            move_files_list.append((filepath, dest_path))
            count += 1

print("Total Moved count: ", count)

choice = input("Press 'Y' to move the files...\t")
if choice.upper() == 'Y':
    for (filepath, dest_path) in move_files_list:
        print(f'Moving {filepath}...')
        try:
            os.rename(filepath, dest_path)
        except Exception as e:
            print(f"Failed. {str(e)}")