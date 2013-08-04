#!/usr/bin/python
import os, sys, tarfile, shutil

if len(sys.argv) < 2:
   print("Usage: build.py [target]")
   sys.exit()

if sys.argv[1] == "clean":
   if len(sys.argv) > 2:
      target = sys.argv[2]
   else:
      target = "all"
   if target == "all":
      print("clean all...")
      shutil.rmtree('packages/')
      os.makedirs("packages/")
      print("finisihed")
      sys.exit()
   else:
      if os.path.exists("packages/" + target):
         print("clean " + target + "...")
         shutil.rmtree('packages/' + target)
         os.makedirs('packages/' + target)
         sys.exit(0)
      else:
         print("Nothing to do")
         sys.exit(0)
   