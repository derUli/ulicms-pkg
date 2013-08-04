#!/usr/bin/python
import os, sys, tarfile, shutil, fnmatch

rootCWD = os.getcwd()

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
      os.makedirs("packages/archives")
      os.makedirs("packages/descriptions")
      h = open("packages/list.txt", "w")
      h.close()
      print("finisihed")
      sys.exit()
   else:
      print("clean " + target + "...")
      tarGzFile = "packages/archives/" + target
      extension = ".tar.gz"
      if os.path.exists(tarGzFile + extension):
         print("remove "+ tarGzFile + extension + "...")
         os.remove(tarGzFile + extension)
      for i in range(2, 99):
         rfile = tarGzFile + "r" + str(i) + extension
         if(os.path.exists(rfile)):
            print("remove " + rfile + "...")
            os.remove(rfile)
      print("Finished")
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
         pkgsrcFolder = "sources/" + f + "/" + "src/"
         if os.path.exists(pkgsrcFolder):
            packagesToBuild.append(f)
         else:
            print("Warning: No valid package. Skipping...")
      if len(packagesToBuild) == 0:
         print("Nothing to do.")
         sys.exit()
      else:
         print("Packages to build: " + str(len(packagesToBuild)))
   else:
      pkgsrcFolder = "files/" + target + "/" + "src/"
      print("Checking package " + target + "...")
      packagesToBuild = []
      if os.path.exists(pkgsrcFolder):
         packagesToBuild.append(f)
      else:
         print("Fatal: Package " + target + " doesn't exists.")

if sys.argv[1] == "build" and len(packagesToBuild) > 0:
   for package in packagesToBuild:
      extension = ".tar.gz"
      tarGzFile = "packages/archives/" + package
      if os.path.exists(tarGzFile + extension):
         for i in range(2, 99):
            tfile = tarGzFile + "r" + str(i)
            if not os.path.exists(tfile + extension):
               tarGzFile = tfile + extension
               break
      else:
         tarGzFile = tarGzFile + extension
      pkgsrcFolder = "sources/" + package + "/" + "src/"
      os.chdir(pkgsrcFolder)
      rootPath = "."
      pkgContent = []
      print("get content list of " + package +"...")
      for root, dirs, files in os.walk(rootPath):
          for filename in files:
              p = os.path.join(root, filename)
              p = p.replace(".\\", "")
              p = p.replace("./", "")
              pkgContent.append(p)
              tarGzFilePath = os.path.join(rootCWD, tarGzFile)
      tar = tarfile.open(tarGzFilePath, 'w:gz')
      for f in pkgContent:
         print("Adding" + f + "...")
         tar.add(f)
      tar.close()
      print("Package build successfully...")
      print("Add to package list...")
      listFile = os.path.join(rootCWD, "packages", "list.txt")
      if not os.path.exists(listFile):
         h = open(listFile, "w")
         h.write(package)
         h.close()
         print("ready.")
      else:
         h = open(listFile, "r")
         pkg = h.readlines()
         h.close()
         if not package in pkg:
            h = open(listFile, "a")
            h.write(package)
            h.close()
            print("ready.")
         else:
            print("Already in list.")
            print("Nothing to do.")
      os.chdir(rootCWD)
      