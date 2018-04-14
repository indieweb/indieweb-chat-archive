# IndieWeb Chat Archive

This repo contains the full archive of IndieWeb chat log data files visible at https://chat.indieweb.org

Chat logs are added to this repo every 15 minutes.

## File Format

Each channel's files can be read using [QuartzDB](https://github.com/aaronpk/QuartzDB). The files follow a simple format:

```
2017-12-01 23:15:06.218000 {"type":"message","timestamp":1512170106.218,"network":"irc","server":"freenode","channel":{"uid":"#indieweb","name":"#indieweb"},"author":{"uid":"Loqi","nickname":"Loqi","username":"Loqi","name":"Loqi","photo":null,"url":null,"tz":"US\/Pacific"},"content":"[@indiewebcamp] This week in the #indieweb https://indieweb.org/this-week/2017-12-01.html https://pbs.twimg.com/media/DP_z5rCVwAAGdTk.jpg (http://twtr.io/1Yx4r5CHSBC)","modes":[]}
```

* Each line begins with the timestamp. 
* There will always be 26 characters followed by a space. 
* The timestamp is UTC and has 6 digits of precision for the seconds. 
* The rest of the line is a JSON-encoded string representing the IRC message and who sent it.

## Spam removal

For a guide on how we deal with spam in these logs, see [IRC#Spam](https://indieweb.org/IRC#Spam) on the wiki.
