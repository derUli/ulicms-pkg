#!/usr/bin/python
import os, sys, tarfile, shutil, fnmatch

rootCWD = os.getcwd()
listFile = os.path.join(rootCWD, "packages", "list.txt")
descDir = os.path.join(rootCWD, "packages", "descriptions")

if len(sys.argv) < 2:
   print("Usage: ./ulicms-pkg.py [target]")
   sys.exit()

if sys.argv[1] == "update":
   os.system("git pull")
   sys.exit()

if sys.argv[1] == "src-folder-create":
   if len(sys.argv) > 2:
      target = sys.argv[2]
      print "making src folder for " + target
      targetDir = os.path.join("sources", target)
      if os.path.exists(targetDir):
         print("Folder exists")
         sys.exit()
      srcDir = os.path.join(targetDir, "src")
      licenseFile = os.path.join(targetDir, "license.txt")
      os.makedirs(targetDir)
      os.makedirs(srcDir)
      shutil.copyfile("doc/license.txt", licenseFile)
      print("Done.")
      sys.exit()

if sys.argv[1] == "clean":
   if len(sys.argv) > 2:
      target = sys.argv[2]
   else:
      target = "all"
   if target == "all":
      print("clean all...")
      if os.path.exists('packages/'):
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
      h = open(listFile, "r")
      pkg = h.readlines()
      h.close()
      if os.path.exists(tarGzFile + extension):
         print("remove "+ tarGzFile + extension + "...")
         os.remove(tarGzFile + extension)
      if target + "\n" in pkg:
         pkg.remove(target + "\n")

      dfile = os.path.join(descDir, target +".txt")
      if os.path.exists(dfile):
         os.remove(dfile)
            
      for i in range(2, 99):
         s = target + "r" + str(i)
         if s + "\n" in pkg:
            pkg.remove(s + "\n")
         rfile = tarGzFile + "r" + str(i) + extension
         if(os.path.exists(rfile)):
            print("remove " + rfile + "...")
            os.remove(rfile)
         dfile = os.path.join(descDir, target + "r" + str(i) +".txt")
         if os.path.exists(dfile):
            os.remove(dfile)
      print("rebuild list.txt")
      h = open(listFile, "w")
      for p in pkg:
         h.write(p)
      h.close()
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
      pkgsrcFolder = "sources/" + target + "/" + "src/"
      print("Checking sources " + target + "...")
      packagesToBuild = []
      if os.path.exists(pkgsrcFolder):
         packagesToBuild.append(target)
      else:
         print("Fatal: Package " + target + " doesn't exists.")

if sys.argv[1] == "build" and len(packagesToBuild) > 0:
   for package in packagesToBuild:
      extension = ".tar.gz"
      rev = None
      tarGzFile = "packages/archives/" + package
      if os.path.exists(tarGzFile + extension):
         for i in range(2, 99):
            tfile = tarGzFile + "r" + str(i)
            if not os.path.exists(tfile + extension):
               tarGzFile = tfile + extension
               rev = str(i)
               break
      else:
         tarGzFile = tarGzFile + extension
      pkgsrcFolder = "sources/" + package + "/" + "src/"
      licenseFile = "license.txt"
      pkgDescFile = "sources/" + package + "/description.txt"
      os.chdir(pkgsrcFolder)
      rootPath = "."
      pkgContent = []
      print("get content list of " + package + "...")
      for root, dirs, files in os.walk(rootPath):
          for filename in files:
              p = os.path.join(root, filename)
              p = p.replace(".\\", "")
              p = p.replace("./", "")
              pkgContent.append(p)
              tarGzFilePath = os.path.join(rootCWD, tarGzFile)
      tar = tarfile.open(tarGzFilePath, 'w:gz')
      for f in pkgContent:
         print("Adding " + f + "...")
         tar.add(f)
      os.chdir("..")
      tar.close()
      print("Package build successfully...")
      print("Add to package list...")
      npackage = package
      if rev:
         npackage = npackage + "r" + rev
      if not os.path.exists(listFile):
         h = open(listFile, "w")
         h.write(npackage)
         h.write("\n")
         h.close()
         print("ready.")
      else:
         h = open(listFile, "r")
         pkg = h.readlines()
         h.close()
         if not npackage in pkg:
            h = open(listFile, "a")
            h.write(npackage)
            h.write("\n")
            h.close()
            print("ready.")
         else:
            print("Already in list.")
            print("Nothing to do.")
      descFile = os.path.join(rootCWD, "packages", "descriptions", npackage + ".txt")
      os.chdir(rootCWD)
      if os.path.exists(pkgDescFile):
         if os.path.exists(descFile):
            os.remove(descFile)
         print("copy description...")
         shutil.copy(pkgDescFile, descFile)
         print("done.")