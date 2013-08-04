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
         
if sys.argv[1] == "build":
   if len(sys.argv) > 2:
      target = sys.argv[2]
   else:
      target = "all"
   if target == "all":
      packagesToBuild = []
      files = os.listdir("sources/")
      for f in files:
         print("Checking package " + f + "...")
         pkgsrcFolder = "files/" + f + "/" + "src/"
         if os.path.exists(pkgsrcFolder):
            packagesToBuild.Append(f)
         else:
            print("Warning: No valid package. Skipping...")
      if len(packagesToBuild) == 0:
         print("Nothing to do.")
         sys.exit()
      else:
         print("Packages to build: " + len(packagesToBuild))
   else:
      pkgsrcFolder = "files/" + target + "/" + "src/"
      print("Checking package " + target + "...")
      packagesToBuild = []
      if os.path.exists(pkgsrcFolder):
         packagesToBuild.Append(f)
      else:
         print("Fatal: Package " + target + " doesn't exists.")
     