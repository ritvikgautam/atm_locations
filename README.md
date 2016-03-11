# ATM Network in India

Structured directory of ATM network in India. 

* The information has been scrapped through one of the websites. 
* The information is avaiable bank wise in JSON format. 
* This information can be further used in a variety of ways.
* This list is in no way exhaustive and is to be be considered only approximate. 
* Presently, only address location of the ATM networks is given, which can easily be run through a reverse geolocation API to get the exact coordiantes. 


The information is present in a format as explained in the following example. 

```
{
  "id": 1,
  "address": "Sahakar Sadan, Dattaram Lad Marg, Kalachowky, Mumbai",
  "city": "Mumbai",
  "district": "Mumbai",
  "state": "Maharashtra"
}
```

The script used to scrap the data is written in PHP and makes use of the [Import.io](import.io) API. 

