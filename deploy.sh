#!/usr/bin/env bash

set -e



# rsync (direct copy)
rsync -lzru --progress newbook/dist/ ../newbook/index.html arvelov@arvelov.space:/home/arvelov/arvelov.com/mw/public/
