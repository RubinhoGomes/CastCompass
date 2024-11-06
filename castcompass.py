# Done By: Rúben Gomes, Diogo Silva, Diogo Esteves
# Cast & Compass - 2024/2025
# Description: This script is to make Cast&Compass installation easier.

import subprocess
import os

commands = [
"php init --env=Development --overwrite=y",
"php yii migrate",
"composer install",
]

def windows_compass():
    os.system("cd PLSI/CastCompass")
    for command in commands:
        print("Running command: " + command)
        subprocess.run(command, shell=True)
        
def mac_compass():
    os.system("cd PLSI/CastCompass")
    for command in commands:
        print("Running command: " + command)
        subprocess.run(command, shell=True)

def OSInformation():
    if(os.name == "nt"):
        print("Windows OS Detected.")
        print("Cast&Compass is starting up...")
        windows_compass()
    else:
        print("Mac OS Detected.")
        print("Cast&Compass is starting up...")
        mac_compass()

def cast_compass():
    print("Cast&Compass is retrieving your OS information...")
    OSInformation()

if __name__ == "__main__":
    cast_compass()

# End of file
