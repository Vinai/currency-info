#!/bin/bash

# Thanks to the dudes at locale planet!

URL="http://www.localeplanet.com/api/auto/currencymap.json"

curl -#L "$URL" > "$(dirname "$0")/../resources/currencymap.json"

