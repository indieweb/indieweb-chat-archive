#!/bin/bash

date
cd /web/sites/chat.indieweb.org/data
rm .git/index.lock
/usr/bin/git add -A
/usr/bin/git commit -m "logs as of `date`"
/usr/bin/git pull origin main --depth 10
/usr/bin/git push origin main

