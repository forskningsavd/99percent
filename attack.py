import urllib
import sys
import os.path

if not os.path.isfile('postdata.py'):
    print 'Error: You need to run generate.py first'
    exit(0)

if len(sys.argv) < 2:
    print 'usage: %s <url>'%sys.argv[0]
    exit(0)

import postdata
post_data = urllib.urlencode(postdata.post)

url = sys.argv[1]
print 'posting',len(post_data),'bytes to',url
u = urllib.urlopen(url, data=post_data)
u.close()
