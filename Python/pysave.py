# https://sebhastian.com/no-module-named-requests/
# in cmd prompt
# cd D:\Python311\Scripts
# pip3 install requests
#
# C:\Python312\Scripts>pip3 install requests
'''
Collecting requests
  Downloading requests-2.32.3-py3-none-any.whl.metadata (4.6 kB)
Collecting charset-normalizer<4,>=2 (from requests)
  Downloading charset_normalizer-3.3.2-cp312-cp312-win_amd64.whl.metadata (34 kB)
Collecting idna<4,>=2.5 (from requests)
  Downloading idna-3.8-py3-none-any.whl.metadata (9.9 kB)
Collecting urllib3<3,>=1.21.1 (from requests)
  Downloading urllib3-2.2.2-py3-none-any.whl.metadata (6.4 kB)
Collecting certifi>=2017.4.17 (from requests)
  Downloading certifi-2024.8.30-py3-none-any.whl.metadata (2.2 kB)
Downloading requests-2.32.3-py3-none-any.whl (64 kB)
Downloading certifi-2024.8.30-py3-none-any.whl (167 kB)
Downloading charset_normalizer-3.3.2-cp312-cp312-win_amd64.whl (100 kB)
Downloading idna-3.8-py3-none-any.whl (66 kB)
Downloading urllib3-2.2.2-py3-none-any.whl (121 kB)
Installing collected packages: urllib3, idna, charset-normalizer, certifi, requests
Successfully installed certifi-2024.8.30 charset-normalizer-3.3.2 idna-3.8 requests-2.32.3 urllib3-2.2.2
'''


import requests

r = requests.get("https://example.com/")
print(r.status_code)
# t=open('html.zip', 'wb')

# t=open('html.txt', 'wb')
# t.write(r.content)
# t.close()

# from pathlib import Path
# contents = Path("html.txt").read_text()

contents = repr(r.content)
parts = contents.split('<p class="has-text-align-center">', 2)
datestr = parts[1].split(' ', 2)
day = datestr[0]
month = datestr[1]
linkstr = datestr[2].split('"', 2)
link=linkstr[1].split('/view', 1)
url = link[0]
print(day, ' ', month, ' ', url)








