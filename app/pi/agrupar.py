#! /usr/bin/env python
import sys as sys
import os
sys.path.insert(0,'/root/anaconda3/lib/python3.6/site-packages')
import multiarray
import numpy as np
import pandas as pd
s = pd.Series([6,3,5,np.nan,6,8])
print(s)