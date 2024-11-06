# Done By: Rúben Gomes, Diogo Silva, Diogo Esteves
# Cast & Compass - 2024/2025
# Description: This script is to make Cast&Compass installation easier.

# Import the necessary libraries
import subprocess
import os

# List of commands to run
commands = [
# PHP commands
"php init --env=Development --overwrite=y",
"php yii migrate",
# Composer commands
"composer install",
]
# NOTE: The commands are the same for Windows and Mac, but if we need to add commands that are
# different for each OS, we can create a list of commands for each OS and run the respective list

## Functions ##

# Function to run the commands on Windows
def windows_compass():
    # Go to the CastCompass directory
    GoToCastCompass()
    # Using a for for each command in the commands list, run
    for command in commands:
        print("Running command: " + command)
        subprocess.run(command, shell=True)
        
# Function to run the commands on Mac, that includes the Linux commands
def mac_compass():
    # Go to the CastCompass directory
    GoToCastCompass()
    # Using a for for each command in the commands list, run the command
    for command in commands:
        print("Running command: " + command)
        subprocess.run(command, shell=True)

# Function to get the OS information, and run the respective function
def OSInformation():
    # Get the OS information
    if(os.name == "nt"):
        # If the OS is Windows run the Windows function
        print("Windows OS Detected.")
        print("Cast&Compass is starting up...")
        windows_compass()
    else:
        # If the OS is Mac run the Mac function
        print("Mac OS Detected.")
        print("Cast&Compass is starting up...")
        mac_compass()

# To simplify the code, we created a function to go to the CastCompass directory
def GoToCastCompass():
    # Go to the CastCompass directory
    os.system("cd PLSI/CastCompass")

# Function to start the Cast&Compass installation
def cast_compass():
    # Print the welcome message and start the installation
    print("Welcome to Cast&Compass installation.")
    print("Cast&Compass is retrieving your OS information...")
    # Get the OS information
    OSInformation()
    # Print the end message
    print("Cast&Compass has finished the installation.")

# Main function to run the script
if __name__ == "__main__":
    cast_compass()

# End of file
