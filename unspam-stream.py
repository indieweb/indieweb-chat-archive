# Run this script to remove spam lines #indieweb-stream directory.
# python unspam-stream.py

import os
import re

# Maybe there will be more in the future. Yay.
SPAM_REGEXES = [
    r"uid.*loqi.*@flashpost",
    r"uid.*loqi.*mastodon.online.*@ahmetcadirci",
    r"uid.*loqi.*toot.community.*@instantletter",
    # Add known regexes here
]


def remove_spam_lines(intake_file_path):
    with open(intake_file_path, 'r') as file:
        lines = file.readlines()

    with open(intake_file_path, 'w') as file:
        for line in lines:
            if not any(re.search(regex, line) for regex in SPAM_REGEXES):
                file.write(line)
            else:
                print("Removing spam line: " + line.strip())


parent_directory = "freenode/#indieweb-stream/"

for year in os.listdir(parent_directory):
    if not os.path.isdir(os.path.join(parent_directory, year)):
        continue
    for month_directory in os.listdir(os.path.join(parent_directory, year)):
        for file_name in os.listdir(os.path.join(parent_directory, year, month_directory)):
            if file_name.endswith(".txt"):
                intake_file_path = os.path.join(parent_directory, year, month_directory, file_name)
                remove_spam_lines(intake_file_path)
