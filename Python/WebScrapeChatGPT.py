# pip install requests beautifulsoup4

"""
# C:\Python312\Scripts>pip3 install beautifulsoup4
Defaulting to user installation because normal site-packages is not writeable
Collecting beautifulsoup4
  Downloading beautifulsoup4-4.12.3-py3-none-any.whl.metadata (3.8 kB)
Collecting soupsieve>1.2 (from beautifulsoup4)
  Downloading soupsieve-2.6-py3-none-any.whl.metadata (4.6 kB)
Downloading beautifulsoup4-4.12.3-py3-none-any.whl (147 kB)
Downloading soupsieve-2.6-py3-none-any.whl (36 kB)
Installing collected packages: soupsieve, beautifulsoup4
Successfully installed beautifulsoup4-4.12.3 soupsieve-2.6

Use the following Python code:

python
"""

import requests
from bs4 import BeautifulSoup

# URL of the web page you want to extract
url = 'https://google.com'  # Replace with the URL of your choice

# Fetch the content from the URL
response = requests.get(url)

# Check if the request was successful
if response.status_code == 200:
    # Parse the content with BeautifulSoup
    soup = BeautifulSoup(response.text, 'html.parser')
    
    # Extract and display the title of the web page
    title = soup.title.string
    print('Title of the page:', title)
    
    # Example: Extract all paragraph text
    paragraphs = soup.find_all('p')
    for para in paragraphs:
        print(para.get_text())
else:
    print('Failed to retrieve the web page. Status code:', response.status_code)
    
