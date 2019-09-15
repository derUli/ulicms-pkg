#!/usr/bin/python

import os
from pathlib import Path
import json

root_cwd = os.getcwd()
list_files = os.path.join(root_cwd, "sources")
output_dir = os.path.join(root_cwd, "packages")

data = []

for package in os.listdir(list_files):
	if not "-" in package:
		continue
	package_data = package.rsplit("-", 1)
		
	package_name = package_data[0]
	package_version = package_data[1]
	
	
	type = "theme" if package.startswith("theme") else "module"
	
	package_dir = os.path.join(list_files, package)
	
	src_folder = os.path.join(list_files, package, "src")
	if not os.path.isdir(src_folder):
		continue
	
	description_file = os.path.join(package_dir, "description.txt")
	
	if os.path.isfile(description_file) :
		package_description = Path(description_file).read_text(encoding="utf-8")
	else:
		package_description = None
	
	license_file = os.path.join(package_dir, "license.txt")
	
	if os.path.isfile(license_file) :
		print(package)
		package_license = Path(license_file).read_text(encoding="utf-8")
	else:
		package_license = None

	last_updated = 0

	for file_path in Path(package_dir).glob("**/*"):
		mtime = int(os.path.getmtime(file_path))
		if mtime > last_updated:
			last_updated = mtime
		
	data.append({
		"name": package_name,
		"version": package_version,
		"description": package_description,
		"license": package_license,
		"type": type,
		"last_updated" : last_updated
	})

output_file = os.path.join(root_cwd, "packages", "index.json")

json = json.dump(data, open(output_file, "w",encoding='utf-8'), sort_keys=True, 
				 indent=0, ensure_ascii = False)
