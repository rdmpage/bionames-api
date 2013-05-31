<?php


?>

<html>
<head>
<style type="text/css" title="text/css">
body { font-family:sans-serif; }
</style>
<title>BioNames API</title>
</head>
<body>

<h1>API ideas</h1>

<p>The API returns JSON, and supports callbacks. It will return 404 if a query finds nothing, 200 if successful. The CouchDB query is shown in the "url" field.</p>

<!--
<h2>GET id/ (retrieve an object)</h2>
<p>Retrive individual objects using a variety of identifiers</p>
-->
<hr />
<h2>Get individual entities</h2>

<h3>GET id/{id}</h3>
<p>Returns a single object specified by the id parameter.</p>

<p><a href="id/ffdaea1678d7dad01843234facb20e8d" target="_new">id/ffdaea1678d7dad01843234facb20e8d</a></p>

<textarea readonly="readonly" rows="10" cols="60">
{
  "_id": "ffdaea1678d7dad01843234facb20e8d",
  "_rev": "1-5f87ba747974ae7d76b626e8261772bb",
  "type": "article",
  "provenance": {
    "mysql": {
      "id": "2282664",
      "modified": "2013-02-24 14:27:27"
    },
    "crossref": {
      "time": 1362070324,
      "url": "http:\/\/dx.doi.org\/10.1111\/j.1550-7408.1970.tb04696.x"
    }
  },
  "citation_string": "Stephen C Ayala (1970) Two new trypanosomes from California toads and lizards. J Protozool.: 370--373",
  "title": "Two new trypanosomes from California toads and lizards",
  "journal": {
    "name": "J Protozool.",
    "pages": "370--373",
    "identifier": [
      {
        "id": "0022-3921",
        "type": "issn"
      }
    ]
  },
  "year": "1970",
  "identifier": [
    {
      "type": "doi",
      "id": "10.1111\/j.1550-7408.1970.tb04696.x"
    }
  ],
  "author": [
    {
      "firstname": "Stephen C",
      "lastname": "Ayala",
      "name": "Stephen C Ayala"
    }
  ],
  "publisher": "Wiley Blackwell (Blackwell Publishing)"
}</textarea>


<h3>GET id/{namespace}/{external id}</h3>
<p>Get an object based on an external identifier (e.g., a DOI). {namespace} is the identifier namespace (e.g., 'doi', 'handle', 'pmid'), and {external id} is the external identifier (e.g., '10.5479/si.00963801.101-3284.465');</p>

<p><a href="id/doi/10.5479/si.00963801.101-3284.465" target="_new">id/doi/10.5479/si.00963801.101-3284.465</a></p>

<textarea readonly="readonly" rows="10" cols="60">
{
  "id": "7278b4840ef8b708f87625a5e6cc84d7",
  "key": "10.5479\/si.00963801.101-3284.465",
  "value": "7278b4840ef8b708f87625a5e6cc84d7",
  "doc": {
    "_id": "7278b4840ef8b708f87625a5e6cc84d7",
    "_rev": "1-890e62209ec1a8228e78b64e061f09ad",
    "type": "article",
    "provenance": {
      "mysql": {
        "id": "2905127",
        "modified": "2013-02-24 14:28:17"
      },
      "crossref": {
        "time": 1362069123,
        "url": "http:\/\/dx.doi.org\/10.5479\/si.00963801.101-3284.465"
      },
      "biostor": {
        "time": 1362069128,
        "url": "http:\/\/biostor.org\/reference\/51910.json"
      }
    },
    "citation_string": "Frederick A Shannon (1951) Notes on a herpetological collection from Oaxaca and other localities in Mexico. Proceedings of the United States National Museum: 465--484",
    "title": "Notes on a herpetological collection from Oaxaca and other localities in Mexico",
    "journal": {
      "name": "Proceedings of the United States National Museum",
      "pages": "465--484",
      "identifier": [
        {
          "id": "0096-3801",
          "type": "issn"
        }
      ]
    },
    "year": "1951",
    "identifier": [
      {
        "type": "doi",
        "id": "10.5479\/si.00963801.101-3284.465"
      },
      {
        "type": "biostor",
        "id": "51910"
      }
    ],
    "author": [
      {
        "firstname": "Frederick A",
        "lastname": "Shannon",
        "name": "Frederick A Shannon"
      }
    ],
    "publisher": "Smithsonian Institution",
    "thumbnail": "data:image\/gif;base64,R0lGODlhZACqAPYAAGFhT2lnVWpqWnl2Y318aoF\/a4SCboWEcoqGcoeIdouJdY2LeZKPe5SRfZqU\r\nfpaUgpmWgpWYg5yahp6ciaGchaKei5+gi6SijamkjaakkammkqeolKyqla6smbKslrGumq+wnLWw\r\nl7Synbq0nr25nra0obq2ora4o725pL68qcK7ncK8pcK+qci\/qL7AqcXAps3DpcXCrMrErc3IrtfH\r\npdTKp9DHrNPKrdjOrMbEscvGsc3JtM7MuNDHtNLMtdjPsNPOudbRttvTttXSu9rUvd7YveDWteDX\r\nuuLavejdv9fVwNvWwd3Zw9\/dyeDXwOPdxOnfw+Teyenfyebgxuvixubhy+vjy+7ozvDmy\/Hpzufl\r\n0Ozm0O7p0vDn0fLr0\/jv1fTu2Pbx1fry1PXx2fjx2wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\r\nAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5\r\nBAAAAAAALAAAAABkAKoAAAf+gDA1P0ZJhUmIUFCJio2KjElUiFSLlJJJilhQVJSbm52clpyOoZGi\r\no1BYoaOckaamjotQgkZHiLeYibmPmIuTlL2Kkqikn5GpraqUWJrIwp+Wx5\/Qq62slYo0NLW4x72M\r\nj6CunbHlw43kocqepKDTxqzVpqihjbRHtre+kI+Nv8GeokVTRS1VpWHqhFWrpmyhQ2jSsuEwgqTb\r\nPFeVfpGjNgVdPEVSQEKxsizTKUVWsCSRcsqhyykLAVKBMbHikXC3ngRL8gTKkycdRcYK2rNRSClH\r\nQ6IThhQKUilRkjZlOQXmqiksqUyJAoWrQ4KzagipWJEnpZ9QphT9yZZJE7b+T5Q+ifKkiV2fTp\/O\r\nnes0KsuuUN9GGQzSCVSoVbBmnaeVLt2QqyImqYFjLJKKOtOh4ukTKMi4jYKqVetoqlORR7kSzvv0\r\naNcqnJAuC0XaJ+RqmzTRpIhryiRcw355\/L1qKW6XC5eaKw5tU9WWq5QlgSEkklUqWbJg0Y49CxVV\r\n3nNbucIp+\/Zm35mlxyJFPZWUzFSp584MfhYr8FOO5wQfi\/79\/jVUXCg0qEBCCDXA8MMMJLxAAgwk\r\n3OCgEDDAsMIPWBwBg4ObHCjhCEdkIYQNFvqwggomnKgCEVj8cGILP\/gQwgo2rCAEFj20QAQQNoTA\r\nQo4kDOGDDzKo4iIJK\/j+gKQMMAyhgg8qCCgPDgwYMIACISDwQgMYMBBCCBgogIEDFLzAgAdieMAB\r\nASFg5wEFGCCwwA9ZzIABCg5gUIEGFXhQAQYefNECBR7IwIAJH3zQQgUjCHrmAytw4KcHeWZw5hNW\r\n+MAAAxos6kALHMhQgQIOeIdcDQ68EMIIrKoawgVfxhBCDBuGoIEMWQSBQghEVHGFhTKQEKoVTpjA\r\ngg8stKBDCyaMQAIRma6ggw4ytNCDDCqsAIQVQwDBwrI9+LAsEMuyYIIPVRDRQwzKtrBCCy3IsAML\r\nRqjUECIqUSFWEVpNcQVM\/lZD0n6bjFcVTPiNRxIVV5B0BXsJNyyFFV3++KpwF11IsUUVGGOcMMVb\r\nYBFyF1ZM\/DEWJDd8xcPfMYbQvhX5djBCnFgFsEPXTRNSUFA8jMUVT\/FXchVVSEGyX\/gVLQXRUSg9\r\nMdEslRwFJ1O3koSUw9QQxFhsHew1wF735FVVnm2VGFKDQbVFpizEoAMUXCA22NRLox100UVrIdvT\r\nJSNWxWBUZPWdPKvA\/PVzz\/X7XBKHex3K1IPhZ4ICBSxwAAIKfBD4VO1N\/NQWS5fcd8mg+4VUFVbA\r\nBjUVXrkUSQ1GFOJbEuQht1BDWAtNhQMISKAAAwhsykADTrDHzFPMdAH606BXsbboqQ+N+tLvJZ0e\r\n4ZzMwNvitruUOzL+3\/HegAYKQKABBAxU8IADT7DXnvFGQ6X3\/Khb0XRregcOG1KpZ6WMgJHQHhJm\r\nRzPb5a4hWYFCFkYAgAY4oAEFUEAFGEABDlQgABqIz\/uQkrGn\/G1pRKsf1Jz2t6jsr3v6GotvrkA7\r\nFIaidrZDSgEOYAAKQAADIUiUAhpggAUQoAddQBlS2KM8jYUOhCYbGn5OFzXY4OeAoahBEYowOxbe\r\njhPbCYUVrLKw8uiHCl9gwQMkkIAEvMAKgIrCBxYgAQg4QANfeOIXgvgU5dUveqnbAskSNjEtUGJg\r\nJHFPKaJYhAFWBYZWMdXgVrGwLoYCdUx4wggeMIEJ+sALP9iBF1j+IIEJcOACFegCEJ2wAqSAroNb\r\nAF3SkqaxJZJME7BkiHyiQwhEXAeF\/9piCEkyBStcYFMOUEAPVjBGA1wABfPqABFisEYCVNIJBfjA\r\nCgYQSr09hXSr\/JgrjTe4WaojOkm4ARVltoqVhYI7A2Ma0ZY4GGrtYAc6qEILFnCBBWSAByjoAANQ\r\nEAX0CeAAFdhCDGTgBCUoQW9RSSV+FAo9K2ghY0FMSSrko4r2LLIaUhwg4xaiSP8IjSSqE9wV7rOy\r\nKxCBAQ+QZgWoIAMgMLMCRCifCbxwhVR2UApaOGUSi\/ix1sBScFhUhSm8KU5D3vKiDHlk02AjMEp4\r\nwQMQkIEJICD+gRRJoJM+4IACopCxohXRlKckmecqFj2jZaybWPyOSZBKha0NkGYCgqF+fOUrKhBN\r\nC7BpmCoShgQFXAACFdDnAypQAXsqYKYmW15Ow2o0K6wtY46dGETVU1H2zCat1fhBERh31LQywzv6\r\nWdr9onI\/u+JnblvQwQIakAENZKACHMgABArQgS40zXRawOs666ZbyLpSj53jZnw8uxDNvhUmLEPq\r\nLJX2tw\/iNG1PgdwWgMCAAiRAAg9YQHZNYE35dfeO09PbKVUZ2bX5533RwWJACGnI7ikjYaDT7Tq1\r\n0FCLGW0LLcgAKCvAAq62MpV6TGUSPwZg3yqNYhPjpmfbYxD+QWp2o7ekbDfvs8TUrbN\/+vGPExPm\r\nBS90TKyt5OPG6Lu2Ei9xvAnb4yuFq1ZYGmQVxn0OeVZmqo7udYlEsytegdaf+CTMtKETcMfMqjET\r\nK8+xJdujEj32xA0qF6nhLKTNGGYKRS4SvtHL8Vyk4IQj\/MQJPokCE6qwZSYMxglOoIthfsJlnD4v\r\nfsANcPM4aLTjWbSbuaNCjJGTxY\/SNYTOo24lP1CBDGAAAh+QAAdMoAE1beEDGvBkokrAARaIoAQa\r\n6IAEVpAxPSL4vqY0ovIg2mOLSmmWP7jMwWpHHkVq58acEOEWtDAEDnBAA8tagQmWJAOprqAHVvjW\r\nu+AFrx\/+DZMFPxIrkpdI5Ao7toN0tCzupBSEcR4SuVoBT\/USRjQB01e3Qmwsezj2hMCJDmVaIK3d\r\ntsAFLsxaofcFnSrlzUc616c\/mP0fIcb5L4S9pzzveR63N4bTLHdhBRqQggbEJQHYcgADEsDAA3Sw\r\nBAggOqUlGKxiJyZgEOJV3htLGH0bS7SMwdI98kFEtYvQBLAlZgovD0XdmHaYEg4GdUtoQRR8EIQn\r\n9KAHQRASEHqggx44AV5KaIFBf748vwE6hDhFW\/8O0xqWEAR3QdWsjEuqMhrXND8Ev2sV8KrbVD60\r\nxB7WIxc8\/OG2K+\/dcnZsgYucUxID2KZBHK6EW9aiIWj+doqFLAIT0OwEJAz+J0coQluW8IRINr4J\r\ng2kCE7oCl8YPHs1PIPwSNt+EJRj086D3vEE3b1AgDEEJQAD9EIYQdNYHgQieFWooKCTNeLnrBbhf\r\ngYVWgCTe6xoFK9C1CVKUAhSYQFkxeMG1llUt28tgBb221s97kKwWILvYyap+0pEu\/aK\/8+dAUFbR\r\ndZADawkyqJz4gRMubIUs0Dg75jFPfa7gsZpewXn37zZ8PIYyiyE4vrmVW1EXgA+lMfMTFSQWgA6l\r\nUKgzavCDdZwgBEOABMWBOoyERQ6DNxaWYyHEYxoDBSwCUR7mBeyxeUghgANYdziVU6Y0P6ejN0uk\r\nBFH+ADqbtwRWR1HVUARgEnxZoCYesG0UpR8NM3arRDT5Vz96NAQMsAIjoAEf4AFP2AJOkGklEAUE\r\nOD8uSGcdV3C5FUJRUAEfkANW4CeDdWdBdTVJIAQ\/MAIesAIs9S7Vwx9yiEf6M3ZHuDHs5wQ+0AND\r\n1wI8oAMy6ASbZzorCF0BaETpZoV2I1pRoATI1ojE5j\/\/EwpBgATtpx1Z0GHZ0QXwB38fdncYc3d6\r\n5AVc0DFf8AUd5gVg0AVgUIodM2sQhTGLlVtC1mkCJopjp0dgsAUdBgZfwGCBM0uqoIY3EARAAAQ\/\r\nEAQ+8AMxMiTL6ANCwHNA5wPHWI070HrH2C2rFwT+QUcEROAERDB6NQgEnkeOqId65Ch6oKd6PrB6\r\nq1eNQzJ9yEhcwYEFFBICORAD8EQtOfBO\/ugDOzAD+0h+OVCQBmmQOuA25Ect0\/JO4gJP4fJz01KQ\r\nRWd9LJADOUJ9xjYt4PeHO8CH+wiQOgCRMuAD\/3ZFPfcaOcZ1LHkFWkB\/XECL7BaTd+duNIl3W1BT\r\n7oYxV9BuNoWTs7ZYPzlr7naFudUw+JFTXUBTgfQ\/DTEW67dtQlM\/29ZLf\/Z0gIaHRhhySaRKqENf\r\nDrWCueUX8TVrfHRbKxg6EXNHgYRFV8MJ1SY273FH9xeHvhIF5rRUgCZfqPN0RZZHWelQ+HFTYrn+\r\nMSHnUN8WgEUTchyYY180OJEwjEWAeYhRFbyUNE70NzBHNE3wdDB3W3wpQh+0SyHEglF3gs4DNWZZ\r\nQtZEc6M1N+QhIP8TBGCGMPtBUgZDUvc3hCGklS\/5mzWFOiDXf3cHXwRXd7T4UBwjd6MWgKnkPIOZ\r\nk1vAOj+GDAIiBFP0ZVAAeJa5MhSoFqkTnFXQeW7heUxweee5BHPTKyFRBZEkBZ6HFE6AKTmlBJ3X\r\nBErgeVHQA1FQUD+3A1GgnmYGOo3Xjk8ABIPBL\/DxTREYBAtgKxZ0ASBgAS5gAUSQBSIwAhzwACfg\r\nK0OAAlxQBUNwARmQARsgAg+QcRrAADkgAif+kCIQQAQf0AETsAMdUAHaUgIscAFLkFPH1wEsMAEg\r\n0AMVsAQL8AHINgEmwAAgsAIfsAFAsDEVYAKEVQElcFUTIFeasEhCIAQRgAEcEAIdAAIo0AAjcAFD\r\n4AUu+kkgqgUogABMcAUjaqIdUAIRcGk+IAE7kAI5YHxT+gEigKOMtgJKMHwc8AFL4AUloJEakGkc\r\ngAIZ8AH8VAKLkgIskAIlEKVVIAHe8gHDNwIVUCoAtApdKgSJwQRTwHJDEKepowVFkBhaMAVawARL\r\n0ARXYBcsNwV2MWaJMRha0BNFYz9bgClboJ62tQTr51jqqQRbYBd0QR5zsQVW6KuQBxVP4Dz+qWRC\r\n3DE42VEKKqSXV8ADL8ADIjAEIxACbjoEMTAEOcADIVoCSiABLoACLFAFO4ACKXABJdBaH6CjyvQE\r\nJhAFwactRJepOtABHZAC\/YpsH9AFKPABlQYGMzqjLHACJ7ADEzAtwzdmvIVWq\/BqQuB4B5MFwwcC\r\nEbABO\/AATTABGSACT6BpXLAEDVChINABF6AEl5YCFpADY8SvC6ADTwBphFYBAqsBHBCokLoonvoB\r\nE6AFiAKGYGACtGWlLMBfCpACOuCEQ6A3IURcWTBUaUhFWtQw1XYDMxAEZ0sErnev+DkEOzAES4AC\r\nW1sFOcAEcKsD1HiMgCgF3+IDy1qORef+eTlHeja4BEBABGNGjdTIA2\/7tpHEBEWQk3fUZ+eEHUkg\r\nIkjwEzC3MFzXfiXlfryYi4vFBfknnY7Vbl3gkw\/1dgs1aqEIYMgJu1pQlLkVk0WJU0eIH9eRHZfr\r\nCl\/LNVFQFS8Hc8J7WjVTQiHUBLr1mVAXXVFgYTUHFc\/bvOqGU05zOlaYbjSHV5hphyOFHenRu5cr\r\nBECxub30MQ0jNEN4hEcodh93VwK4ULSIZGAJYGK5gu+WU2OXbl0oXl9ZP7EKQ3wnBpe7HVLmLwET\r\nMFpBBQGsTYjZl7rVMO+rBTqAbBacLL+na\/Xahf8LNWRnmGH5bdmrW9xmYfixSIJkj5f+Ub4AE6ta\r\n0W\/nu0sbOJ6AZkI1\/EFRYT+31ZdJI19dWDJcmzeJmG6hgzfcezp7d1FTJLyHtDL+0rlIqbsXVgXt\r\n5ivP2b0ghIfjkVgWtlhu9lzRY3cdTItEaIRJOTCYRarHxXUM08YM8y9DKHJGOAQ8QMVRAARM8HY0\r\n6TFesDFMoDEBmkqoS8U7mZwak5r0RYTYJJxRvKDKwB3ekQWFVL4wDMMveb4fA2hWAAYcEAHItLIl\r\nIAIuIAIZ8KLuogMloANekAEt0AUsAKQfQH38NXwowAEHlb1iB799I1\/3x20Tc1GUi53lqzixeskM\r\nY5UG83RccAIgMAJ1iwJAkLDMbHz+w7cDJRADUHCpTdADOaBrPGAuQDB8OQACPKBb1ntXQOxmz2PG\r\n2iSM0XHAM8YJJdXGnUtfsiqYiSGn+0vFtbuTXsAxhkky9LWUqMtutfvBRYaHYDm\/IgSWJ6x31\/Md\r\nKpQ45IHAT5xLucTARANzuTUenCl2nanRZkk6Y+c5Cz12VojO\/IuVMgxeeEQS24rChWRUseo1R2mZ\r\nx9yXe7m5oTmeUWAXzTU3HmRH4QWaf\/ab+\/tt3Xa+mMxUAmwqqnDAsvrGbaxInVvCHe1QYwe\/W0AE\r\nHTACGVoCIwB8A2suPrBHZifES6OYvtKFKTgeR4kfXVfV34S5XzPP5uTECBzH8Fv+mvvcm7spnTWV\r\nUyCjUApNdrr1kltdxut02InpR5XbCpE8RS0Xqy131\/3ixB+NOlZpF3jVmYttc3ZVmiA0vf0zxNrL\r\n0n3NvZy9mVsUMJEcyZY706vWkiyZBb2kMo\/NwYl9f5J7l\/\/CwF9XMXg4Yjb3dnblkrLKv4r5kivz\r\nku3mxN\/brd1KEVNQJxhwtlRUHan6LzNwA4cEePa5epA7BOPJBCHQeDHgAjFgAihQBVEbAR2wBEyw\r\nAogLBKxTAUPABVHAASCw3iZQBHgcok3gAi+wBS9gApvHBUOgATNQBEGgBFPEBEogBOb0sYggyYqn\r\nBTNgARtgARMqoRzQAE+wA2D+6gAncAUf7uEbEAERYAEgHgYuYKJc0ATNnAH2pANcsAMKUAKY5oQ0\r\nGgVBIAEocKsX8AAIO6ORKgVFYAEcYN4csK8bEAUmzuIgsAET6gAhMGOsZrlJUEixGgQu0ARDUATX\r\nOEU1UBXVFgRxqgTuSMc8sHpF8C92S2ZwS+ZLsAP3F0mGS99MQAS25eZ\/Y3pDQAT0fcdEwAWGrryg\r\nR2bnqQSoOgWQK7Yw1GoFPEUggARZEAZIQEWQnB2ahQJUMOckZRdXYJ8vmQUxcAIxMHZvEd08MAND\r\nABT015NX4AVv28cMPgRggFcz2DRTkAMv2QREkFumh1dT8AI7wAVTsHq+ctH+VC3bRlAEDdDMXzIC\r\nGCACG8ABMzADYNLkPBACGTqmGVrKIHDlwZ4AF3ACG+ACzQwCM7ABTODuLsADTZABXz0CmoavcjsB\r\nifKkhWZrLRvKIEDKFsADLrABGxACEwArsOJabYJtAMcJU7QBJEACLjADOTADLtDx3BgDJFAEI3AC\r\nsn7ujMu4BYnwLkAEJ5CpHN+uOdAEJ8\/xsv5O5LcDMdAEQJADjqgD3rIBOsADORD0Q9ABHADzMWC3\r\nO1CQ+igkbpMDLoBcLWRF2CFlYTBSVREGVx8G170yXJ8dDdNL+80DRTAGXAAG9toErdhubH96bD8F\r\n\/1wFULCUtx5JpAgGqoj+V+2G90oQk\/D9z0zQYbceBh1GumCA91cvz1RWY0UgBBg\/BUIQpjPwA8l+\r\ntjEQAwxi4DtQBeHuAlrQAEdf71wQATvQ8QbuAkzQojGAAlBf+ihAzarsA4BqLB9ALTGQAlS86huQ\r\nApgqAjswBRzwAiiA4GMNfFXwAiWAAkEg3RPvHVME4zwQBM1MoVcAAi5AAjEgAiFg\/SAwBE1AAh3A\r\nA09gsdvu+RfQAdtey92PTzsA4vguAvhaAh3wAT4QBfiqAYH61TEwASWgBTGQsICwUVICAlJ1wgGy\r\nFdNRoiGyVcLBMTM1dXVFdZVE1UklhFTUdGl5dal5lZWFyRRUdWWlVaX+RXulNco0O2trxWXVZIWZ\r\nFXYVRUv1xGXstSvLpdTExaW7pDVdVcW1Jf1axcT0dEXcmZSZ6VmEpH7FVHTlUjQVhEQ1ZTT19LKz\r\nM4RfVRRES5AgLoKI4IeiSRF+RJjEyMVjRxEiIqJA+YWiRZUVK54M4XIChAgg\/JQw4ZLhRBMeIoYs\r\nKdLuyqsPF0IMMVLu3JQsVLIkyVKkiAMLGxxsCHFByJQTDprsaLDBQoYLIohe0HKiARgQGTqA6GAB\r\nhAUOEThsABFhQ5McFkaMlWTyQgYgTy58qKBBS44EF1wsyCCIy9cNGzp0aDCpQy4uOzrEkCAhXCee\r\nPSsDbDDjxoYZSIL+WBISb8qMgUGGDGHiwoUVJR9P7CBCRImSoEs4PGxiekoTaEOaENHIjkkUK0u+\r\nVVOyg4cS5UuOQ8O9pDeTJVO0XHnyhIlLKlasUKbc6R4SU0FUXRk\/zJSwLB5nMJnR5AoX6th48PAl\r\na0qsHEzim9qxyhVQVBHFKzoYo4UxVGQTBTT3VdFEE1VM8dEO4bRTxRDZ8FPFRVZ4kgl4RcyAgQiE\r\nbYBICC4gNY8FJIwgUgcZDOGCBRc0IQIILgxRiAUxDJEjVRmAcIIVKYQwQxUZRKHDByWEgEIFH0xi\r\ngpOFdZCCEhNMIoJhRIGAgWEVjEATEVeIwEEGHJhzjic8AaRiaiT+5LDDDDOk5lkQRQyxQ2ruMZED\r\nD7jx0NsOObgAzT5ADJEDnRlyyAKTKQCxxA469KCDDvvwkAML9jWRQqBAgLApD4uekMGmKEzhQxD7\r\nmOMJFT91Eg8mYWgyTBZIhMGTOONpEUaw8kyRixZFjDHKGE80kYU01nmBSTTByteFmV1so4UXYGg7\r\nChjPcKGFt1rIBsYWMk1hbjZcMCOTFWF40Yk5WPQ0axFGkEAQCVfcOcNmUwgBD49V8ODCnRvYJ4IL\r\nI8RwgmsbFMFDDPyEwB8KL4hg8Q5gDBGCDCmkoAMXQ8TAQmNK6JBCCSWnoDHDLpzAQxQHNcFCDCOg\r\nQALJKFg8Raz+5FCGhBAOgHBWEYSd4MIGUyQ9Qw4bMMEDioXYF9YJghBpARMndOBCEyHxmcIkHMDM\r\nQyMlmOAaEBqckEIHS5jQgQkcfJwCoSlYvQOOyu0skgsciFDCCCEAw12IP\/kU2iXWXXJeeZpwobh8\r\nt1TXhBZTSFMduIpPgwk2r2ixRXacV9HFdZhcsYUWVOwQhTLZQIitubJssU3nltDCxek++9TTPUEF\r\nNQWSQeQwBRJT7KBnhEoEdEI8JxDEAxO3aBeDPFC7MnIOK0zhBQqi\/CjDaWZ6Q8QUD1UBBMjQaccE\r\nEfv4ABMRfHLhQgwjelZPZfPOmgQSM4RggRAQhgMXaEBqwhL+lg2kRiw7EEtYiEa0IrigA4URixJc\r\nkAEXlO0EFTBBFFAAgr+JwAQluEAJ+CSBElAQCCVICdEuECjAfOUEgxDBB86iBMIg0AW98gQWvpOO\r\noAShHUZAjhCEoCdRwKQdQwwCoWQDGle1zyS74QITTKIdaETnCUWAhnCW9QQZaGdZvWlCc3ajBC0Y\r\nyoy+WUIUotCfIvxjIK0IQogqI6vJIMEIz8MEFXilCvMcL0KnS4XlbHES7WAid1fwQvuigQ1iPGEH\r\nXliFD7bhAxnIBwxF8AEXiAAEY4DLGrKwji2sMUYrnCYMSriEKjQRLzeFZwoNMGAANyCCJ5AASlZI\r\nBJFOoIX+sxSCSMLUEROIxIESoEkSIRnbExJxAhNU4QMdcNIEItVCHdSmAyjogKmI5IJBNEwLTJiA\r\nidAmAg1UoV88CIIFYGmOnnkiFBqEQWpcQDw77eAKQABCwSpBkNTUCVGpSZQSgNAoPvEjOTyYAhA4\r\ntQMtDMEH\/MiBD6qwj1HsgAU6YIFTYHa3iOxDjUvIgQ58MIQX7AZRRdBXLNv0k3isI1jBesKubnW5\r\naV1BCFwIgzR+Wh1iZIgImvMWF8pVhW1IAwxSYIIXhkCEAh0VDNHQRn+aYIwx0MKo2RgXGJaghCqM\r\nIRs+DYPxThFLeolmMy+onwte8AIQvIAEJKjTC2Jwng3+xOBuqaGfjuAxBQ7wIAUxeNkKUsBRFHT0\r\nCVDwgQlYQIYMfOADLGCBDFiAghxUrgMaYIEScpACfDZKQjvYGRg+8IAdxAAFG10BC0zwhO5wJ1aI\r\nCwIIZoAIDpCAaycQAQZGgDQYEQsEKDDRWfxKmIieYAhbi0EOSqBYFJhgr+QsLg+8oIEPmGC7jdiu\r\n9OQW2hSAoG0qHEIUBpEDLrQNBZRFAQdYcIETSEYTHxLRFGp1Ou+MAxPV6ZUVsnG7aNDCOlvABuis\r\n4YVSbgGOUrjCtWohC\/n8tAvTwNaBaSEha0yDFlWAFupody3dwSqWRRBCWODhniQEoRKryAKS9BOP\r\nEfj+wAV1il5A2DEE1mZoCR55gg6y8wQgmIAuwnHCdL4x1Cg84aAuaQKlKreDEyxhLVV4SPtOU4WG\r\nsK8IwfBZrOzVgC9Z4AQW6IAIqleFLHylA09IoJkFcRYLJAQEE5DEBDaQAyBMgJobmOzZ1BRCamYg\r\nAyfsygXW9gHAAHoDS2hEBy6wgSq0UALu1QARqlmBCmRgArHFgqfndceg2IkHv5vIDOT4IT31wyVD\r\nYM0SYqME9xEBQrE+KK2nXJwrym\/K4DBjb6qgAxREwY2xmbJs0nhsl1SBNaEcNoGmaJLudGdePksH\r\nElq8imCY4hTseYIXoOWFHXR1CNtInWkqJw0JfZX+klvoQhccSQQwyGcLU\/BWsYjQhR4sAQwQwt2A\r\nswUGLXQBCvwewld10IUl6MALOpACFj70ISz4sR7uvO1ZSLCjC3DAzCEYAV1FgLElXEAkHOhmCkSQ\r\ngxCsrQM02kCVJuvBZFZpByvQgNxGkDK0fUAHOYibCTLAsmQ2DEswnywKGl0CP2cALx54wqe9TAV6\r\nviDHKBjBDoIXgxjI4K4Ey0Fhl8DaEwRKByKYUaM6tRwdDHajMdACZTuqhB6Y4GMt4KgSMKtvT1X2\r\noCwQr2f7joLK8jwKKTABD1gwkhygIAYNtsK8PM0TxDGukVmwxA6CVflcTSt3n+TCGNa1LCuq6xn+\r\nu5myTFoHhtRvYd9kSH3qw6Xk1HehXFF4fROoGi7Xa6EXzEgqEJhABm9sQbbUjpWKRbACFKyABG2V\r\nswo88IIZrCD6RaDYyBSoUug6NwRSXgILntaBCYxABo\/tAUdXEIUP1P1umFXZIIDQUR0ooQN0OrwS\r\n2NZ3OtGsBUJGgZA14APv5QWy5XjFxx4+sDNVVwJIgwEcoAHENQKJsAFBQAKuYTN2kUPd5BUfAAQ9\r\ncDYfVE0mICUsQE0aYH4c8AEooEIlNwiNMAFw0wQqNF4bwFFdsYAlAHZnEwM3V3JxQ4BQhwRPcAmv\r\nwF\/B0B2FJA7SIBPZoFTW4HtW0AX\/lSAFRjv+VdgdtMMF1wIEUgAG1zJ8UdACOiBgpTRgo+QsFCYT\r\nCfYESgYvVTAvEYdHUfdMVndfeCUPLzAFKHADxfMvoEEh\/NAO0ZMLwqEEy6Jvq8F\/UkAgTuAEJqAD\r\n4NBPjLgEC\/Y2S6YDBKIFjwUETdADSsAkKyAFjlgcO7AEQGAFOrAALJAL0vYhVFB8clhAaHIBFzAF\r\nGnABPhCABFQnGicBY8MBNgIYidAEQ6ImTcABE6AExRV+QMAC2UVNjiYJGiABUbACjTBNkvABmagE\r\nMsgVaxMFUiKCLTQBpPgAHSABOyBtP0RbUccE+zAEQTEExpILVzBR5WMFM4AC36AdQ6Ac55b+IbLh\r\nRkCgBG7kEp6oZFfkicbRHJ74BGBFHAPpHGAFkM0BRwjZHG50UNqRVLLlinEYhEXwBM2SBWOwA1QQ\r\nAy\/gA1nwbamACaWDOv\/2ki85fFbobl5YkzaZhe5WhV0gcNJQhSD2k0G5k7BwLbkTh7uTBDNwASMQ\r\ngSgQArk0AgnAASsgOCYQArq4hP\/lOZ5jBQWiiN2xkdjwX1egiFJglqXElRxWBbFAC29kYLogBQuy\r\nlZ5TIKgwGT3xSp0QCjujdaX1Au+hfCQTAz6AWSagEWKJDVOwlZUzHAnSHVJgDFC4BVJwYFYollYg\r\nBZMpBb5glsbwRrdgYF1ZILZQllqgiBP+kgpeRhnxUDhFAAVf4GHfdgmV9G1YIG9VsCyLJBOruG9Y\r\nRTsItmRMAAXagB3NcRrvFlszySTasAUREnDW4G4EMoBa8AQddi1W0G5dUHmy5DNB+ARbQJUUswMy\r\nED4SswNAkElMQAUrUATBhgI8oCkpEAU7oDImkANiJwU6AH\/kJgEX8IifJAEVsANO8ohhSJlb4AQQ\r\nIJDnxVqmGIbo2U9RIGQxoClKcAXnKQOV0CZ3qZdOUJ1AIAEZkE4igHg7MwJW2QERNRIt0E1\/owEc\r\nwBobwAEtMAlA4AQdBAIsME2C0AINogEasALb9QHoZ5+ZuQQaAF3p93Mp0AQbaALsVSn+chM3LAAS\r\nRyEC8vQdX\/YE8VIFPiAfAWIF1Ykr1xAFqFA7BUYLlHmd2TmAmakNyICZs2Ca7PKYQNluCwY6SRUF\r\n14k6nOMFRKAJw5df6zhPSIBSQxBGIoBEenIDMkAFHkA9RQCAsCU\/pwEEDfFBORAFjBhrbtSJpfgE\r\nRHCJOmACTNADK+ADTBCKRLBkSuAElAJWjiihSjACRLAEPZCqdPGqpqEE8GMa8QIentA\/QqBxMtIB\r\nkxACIBACXTEEBDQBGbAEFUAEz2oYMARpE\/CsD8ACIFABg4AXL5ppGkB\/JvCAeCEjmPUBPzpoGjAB\r\nEOAkGlAY2moC2ComFcADGfCiaZL+aRXAaa3YiloqCtkBDsKBD+3oA9jRDlwUBbZKHWElkWAVM8O2\r\nBE5QkBAJSoT4Ni0AVoxIsQI5KvqGkcd2kQsJVlIwsUuQAhPbkFE1W49XfEE4BDJgLtyRBUZoOlng\r\naV7AKk4gqlLwXyVjHzIAha7qbl4AmV3wBFLwbkOQn8NBkTW5pxT2k14olEAZhbRzhd1ROrPVkd0p\r\nBIkBMiL6AUxpAi9QAjYDBCtAolAgF0OmBRHwADSUCDPqfyxwNq9FlTpAlUogWSuQdN5HCBqggi0g\r\nbZlJmW8EmaU5l1\/ZmVJwCv\/anUigdVN3d4M5A\/uAPCmgAe25A+BAMvr3JKHSKfL+2QNA0AItoATV\r\nCH+l1aMdhSkrEHcsEIale4mpc5azcLtRYJZJ5bPDwQWdqZlr2QmeFitQEIRD+I5UAAZWAAZUkIW5\r\n4wQOtgpFULTe4CxAiZm114VM8gTXgrQC+QVRoC3vdi1J6wS0UyBMBZlRkDpeCJkN6QTVEAU+sJmr\r\nt6cc6UPo8ASc8AQVgAHkaQWnKgO4OMADbAUr4AE+0AMbdRDmRScssARd0AIeAH8RXAIcsW8swAG1\r\nGgIt4ANAMAJA4AXp2gNfAAQVsAKo+1gsIAVO0Il35wRRwAAUMAReoAQaEAWlOwIeLLyvqL+dwAQe\r\nkIIr4AVUyZRBKl0tgAXKRwL+HLBdL6pZLsQCVuABVcwBprjDItAD+WYCIsCUI+ABHNECXtCMLSAF\r\nQGBDkpWCJTCQGaCCI9EFjsBjTjC22uW3IdC1UJcOSdAzVuAFPuCKxAuFXvBpmOCzldc5EyIhmBmF\r\nSuuzmOlwZam7XWCWhrt7iqi7p2m4ZtkEk6m7uvubX1mnievIUIAFUFBtU3BoRLAnrUAEPoAFRGAC\r\nUhAEMbAC8+IEOgAbrLUEGCUC0RMdHiqJiOoEkJmMYGCYLaBvpjmxmblkSstCGitwlXWRd9fJymyy\r\nJjux8buplfyGnYDKVBAPDCABP4oUTpwBDakBVewIpYGCUcACvTUBD8UBzSr+pE6SdCXQAitgBVVS\r\nAluRMvkspJUlXiPRA8nkNqEoI4SWdCawBSREaFvggGniAReMmT6MysaLBPwgCk0wAkogBUFmstiR\r\nHTEcqm80kEQQITwQHTwGR7iWw2lkRpN4bBAZv24kC5uatFs4ZVEQIQI5sbKxehdpBf3UHE4Qd6c8\r\nvF6WDnjVjuchA1\/wY12ABSEWDJPpBNiZO7IwC1zgG+7GY9dSOQWGmaaokzeZnVvwVUrQBZ7Yye2G\r\nVQkXwZMJYm50vl0Ahi1QzHFpBeEcuQ34N1WnXQBYxSuwwShYJVXnxfkINyAAXRqgsYK7AuOVoyPR\r\nxSTkfS93wZT1Nh3QAy3+8AEY8wFK8HOEQE3StAROQq7JqDJaMAHlqAOnLNumHCvqkHWZdEI+kCm3\r\nCsKCy1qa4gONYijzCVol41lOkBGyW3cskAEnY34e1SnPfaotQDMQrATLDcGV9VqYxX9LoDKvhdSP\r\n9TaUdbAQB85aCj+502Fe8G5ScARM9QSMWAXb0gUL4m3DuQ147W1R2ASzR50Jst7ey5P93YVkUJPt\r\n1oXu1slkkJkCF1aTLHvn+8lcSMlmSQWorNTh7JoOcAEcAQM7WHc2AIAsQAQ9YAOGOd0mQAJAkHWq\r\ntQNk0gMuTAH9xAIy1gMT1QNBIMFSsI098NnKfN2lq9dLANpE7lqoO9r+dxe722i3QEB+NO50UgAF\r\nphyXUy7OSIABKu4BI+AAHBDGPtBxTWcCKzDEI+BaNmO3HFABPnCiFXCqX9wCKsACQbrlJjAE6ue3\r\nLOABdjtZapt0dad+N0yCZ7NdfNsDTjJZ2tXFjvABHgAFPuuKVg7O6oCb8nGPEUzJOqmZN+luPuAE\r\nXrAFQhADVDAcD+ezjoyZk1nDLXwtZuluoFPhnRnrhqu7CeLTZtkDpvlGu667uKm7VOBwtP3oUYcE\r\nMoCqQnAasisFQxAEToAFDmfmLcCqpwoOC8ECJv0EQbAEZjkEZjwcqdvCuhvUm9ocn82FS5AB5tcD\r\nw2aWwtYEToC6Jqv+BebXowdp10QA6abs1\/reGRDgCCZUASfwo+mqGG+UaDRKx+mEr1NxAeYHAdy6\r\njcn0o0oAAi8KAeb3ANTUBC1wTemqAU6mreGHrXfnxl3xjBXQgRVgGNklIw5YAWbMHcWHylIOktnh\r\n00r2RhECR\/ERIRtPbrLRavIjG2akb544kAC5Gsc2bNfdAng606UoBaVb02jU0xNZzf3kElfUPjJA\r\nBB8Slxd+4aesDvTwAt3gA6j6X1uKLt0rBRoRd9DieAsmmVq5BZHiBfH76kMABOXS1pDpWQInBRDs\r\nblJwexu\/7lVQuu7GAwLHk8P3bgdlBTJAOvjbCZEszrU4CematpP+FTeCCzceoHxD1gEecMUtYEOL\r\n7gGXyL4PkNojwE0cFTfsReYiMIwaAK3DSE2DsF3o\/gCBrzJDWk2q3QFRMAQrkAHB5oBNp9RLbeVF\r\nkAQUtQMvkLIkwSn9dJ4s4OM8sO4IhU0pANoogCmh1JUg0AQrHHjX3SnYT80l8Nn6xv6V9dw5KH+e\r\nglikWlmuNdrSxQR6W3gW\/vXnDQhUSEgyQU9cT1VdWUVdTlBcXl1dYIg9S5NRTFZfUVFOV0RORJNd\r\nXqeSpV5bPVJdUk2UpWBaWpNkUVKpXVZglL6pUFunW11XplZSUlTMy1BSUEhPDzIgLyMjKygmVBca\r\nLTImMiw9VhX+GkArOj49LUAtIl4VDx9AOuMt7Z4mLEAsCU20sCjRgly7HhpYbFHCYqASHS2UbAHy\r\njgXEFkNa6NCxw4cMHyZaSMHCrNkyZkWmeIgRQ8SJEhw6sFhiogTMER9KrKiywsQHESw+COXwgYWW\r\nEhRWZOjQQUOHDxwiTjCh4cO3KDWZWs1Ar4MTJRtacBibgYMWEBVAwKzQIUMFDhk0vCWKQQjJklCo\r\n5I2GBAqTKoADQ0skpYoULcqkREkG2IrjxNCUeTIMGXIuJZKjaNkixUm\/XK4UW\/HkRLGn01EwWnny\r\nxBPrJ5ChQCEpWxCS0lNKWvGCBUupZFYmWaniuPdIKcGXPXb+\/HgSFs7FXnEOXUxK9C7TeTEvVgx4\r\nsS+SkiEvPptKb9l59RqRBmVK7tUtiLDrIQOJoyFOOGNJ9soKluOP7TfeK9RZR+Akh3WBmDIHIpdY\r\ncq688koULLQg0itYzDYbNOlRwSFfSaT3BBY\/UODBCB5gkFQPJmDQQn\/JBUigf8hpdxx1BGbH4I4S\r\n9riFeBImA0YLBZzjxH\/IaXheSc1QcURftcmWYRJ6yRYaa9rxR6Bvx20ZYWIShhYmgjwyGGaZwplW\r\n2n9sjqRhbVVK8eQTeTlTZ2JIOtbfl64gKeF\/BB7nG4J\/mmlog2SSyeWhSLo5W4b\/zWaFh1AcwZps\r\nVkAxqV7+yvD34HKAKsMlcxiS1GaZjUZYyo56hsanj5A16qF5tX1YKZRw4iXgf+K50mplCLbZ6Jlh\r\nchnooVZw1iOYrhroZW+UZlhllUdYKlsUlFKRG2QzAudtjXj6GW6PhO5YnZjUeTpmaM3xQqZe0JoH\r\nDbWDoFenbg4qQxxwlIn5n7yh\/ethsw1ax2ygOqpaJmfAiXrSM3s9Qy+uHEIm3sX5fpovM5E6PDDB\r\n6CIK47o7doocw+FKzCmlshXxpL3pcdhrxtI2u1+G0JyHpHE3HvtlqrwwC27IDZO5zF3zxinEyzBL\r\n\/IzFT2ca2sfDLuOwlyGXzC7K7prsapYO6pWMhg+jB00ktUdAQWfTViYmsdWQmXTjzpUtCiy3yiT8\r\nLYadJncqbc1EiV4gADs=\r\n"
  },
  "status": 200
}
</textarea>

<!--
<h3>id/&lt;namespace&gt;/&lt;count&gt; Retrive count of number of objects with identifiers in a given namespace</h3>
<p>Use, for example, to see how many DOIs we have</p>
<a href="id/doi/count" target="_new">id/doi/count</a>
-->

<hr />
<h2>Publication</h2>

<p>A single publication (e.g., an article). Basic metadata can be retrieved by GET /id, but what else can we get?</p>

<hr />
<h2>Taxonomic name</h2>

<h3>Ideas</h3>
<ul>
<li>List of related names (define "related")</li>
<li>Possible synonyms based on matching epithets on same page in BHL</li>
<li>Time line (e.g., BHL)</li>
</ul>



<h3>GET /name/{taxon name}</h3>

<p>Return one or more clusters of names that match {taxon name}. Names are clustered to remove obvious duplicates</p>

<p><a href="name/Philautus acutirostris" target="_new">name/Philautus acutirostris</a></p>

<textarea readonly="readonly" rows="10" cols="60">
{
  "status": 200,
  "url": "_design\/taxonName\/_view\/nameString?key=%22Philautus+acutirostris%22&include_docs=true",
  "clusters": [
    {
      "_id": "cluster\/622393",
      "_rev": "2-9b1268ba5ba8fad2cb620b8081ee2973",
      "type": "nameCluster",
      "names": [
        {
          "nomenclaturalCode": "ICZN",
          "id": "urn:lsid:organismnames.com:name:2634803",
          "nameComplete": "Philautus acutirostris",
          "genusPart": "Philautus",
          "specificEpithet": "acutirostris",
          "rankString": "species"
        },
        {
          "nomenclaturalCode": "ICZN",
          "id": "urn:lsid:organismnames.com:name:622393",
          "nameComplete": "Philautus acutirostris",
          "taxonAuthor": "(Peters 1867)",
          "genusPart": "Philautus",
          "specificEpithet": "acutirostris",
          "rankString": "species"
        }
      ],
      "nomenclaturalCode": "ICZN",
      "taxonAuthor": "(Peters 1867)",
      "nameComplete": "Philautus acutirostris",
      "genusPart": "Philautus",
      "specificEpithet": "acutirostris"
    }
  ]
}
</textarea>

<h3>GET /name/{taxon name}/publications</h3>

<p>Publications tagged with {taxon name}</p>

<p><a href="name/Apomys/publications" target="_new">name/Apomys/publications</a></p>

<textarea readonly="readonly" rows="10" cols="60">
{
  "status": 200,
  "url": "_design\/publication\/_view\/tags?startkey=%5B%22Apomys%22%5D&endkey=%5B%22Apomys%22%2C%7B%7D%5D&reduce=false&include_docs=true",
  "years": {
    "1905": {
      "biostor\/79013": {
        "_id": "biostor\/79013",
        "_rev": "1-a2ce1d06b8d7e386e1b60d34dc9b8227",
        "author": [
          {
            "firstname": "Edgar A",
            "lastname": "Mearns",
            "name": "Edgar A Mearns"
          }
        ],
        "type": "article",
        "title": "Descriptions of new genera and species of mammals from the Philippine Islands",
        "journal": {
          "name": "Proceedings of The United States National Museum",
          "volume": "28",
          "issue": "1402",
          "pages": "425--460",
          "identifier": [
            {
              "type": "issn",
              "id": "0096-3801"
            }
          ]
        },
        "year": "1905",
        "link": [
          {
            "anchor": "LINK",
            "url": "http:\/\/biostor.org\/reference\/79013"
          },
          {
            "anchor": "LINK",
            "url": "http:\/\/www.biodiversitylibrary.org\/page\/15393041"
          }
        ],
        "identifier": [
          {
            "type": "biostor",
            "id": 79013
          },
          {
            "type": "bhl",
            "id": 15393041
          },
          {
            "type": "doi",
            "id": "10.5479\/si.00963801.1402.425"
          }
        ],
        "provenance": {
          "biostor": {
            "time": "2013-03-11T16:33:22+0000",
            "url": "http:\/\/biostor.org\/reference\/79013.json"
          }
        },
        "citation": "Edgar A Mearns (1905) Descriptions of new genera and species of mammals from the Philippine Islands. Proceedings of The United States National Museum, 28(1402): 425--460",
        "thumbnail": "data:image\/gif;base64,R0lGODlhZACjAPYAALWrgLyvhLyxhr6zisG1jMS6jci8jsW8kcm+k8zClc7Fms\/Im9DFl9LIl9HH\r\nmtPKndnOntnRn\/PVnPfantXNodjPodfQpNvTpd\/YptfSqd3Wqd\/YrODXpuHYp+DXqePbrOnerfXa\r\novndpPbeq\/rfq+XesejfsOfgr+rhr\/7ipvfgrvzkrf7orufgsuvktO7otuzmue7puvDmtfvls\/Lp\r\nt\/7rtfDnuPPsu\/7uuv7wt\/bwvv7yvvTuwfjvwPbxwf71wv\/5xvz2yP\/6yf\/+0AAAAAAAAAAAAAAA\r\nAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\r\nAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\r\nAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5\r\nBAAAAAAALAAAAABkAKMAAAf+gBITKSwshIWIiYiHiog5LDWPkjg1lTmROTmUmTibmZ+gnzujojs5\r\nppmooauhNRIijI2Kj5WFNSyXkZi7kTisv6mhpsOno6TFxsnGp6uqOSEiKzOI05eQkLeV2p41nb7A\r\nzajKyOPK5ufo5p\/QK7yWM7uX35Xfv6T3xeTp+6NA6f78zoWQBo+et4PfEB4UF7ChMYDKID5M5g+g\r\nxYnqBs5QuIPjKW8dh\/kadi\/gD3NAJO5IeTHlSosVX7pUqXLUCBLdFCI01UkUDmM\/9fE7ya8i0ZVI\r\nW1Z0+XLlD6b9JIbY2PPTT1RXlzk8d\/RhzKb9dvx4yrKs2bMsyZbFuOPmwo7+nUIy29p11FiMFolK\r\nTDkWiNq1ftEKMdv0q7ERVINeXRzSZNeTj5FOfBrVaN\/AT\/8KTjkY7dpRUz0my5ruKORkd8VCXOo0\r\nZlrPm1kGSRmkM2DJbeGBXJhV6D6ip1MnhRxY5kvNQWbDBjJbyGDbnpEi3lnSWF2kkFMDFC72NEyZ\r\nLMEH5sxXM0voZ40DRFyjBw73jn+HtetXddKkSpcuR6vcufPoMU33XlY4XGcOZdaJFVZMet2lmXhl\r\n\/ZAcbbR1ZiFnF\/5HmGQCkjbUgXbhdhGCfNW3oH6ymXUhEM+R15x\/ZyG4AwmJyacgRMBl1x12\/ozl\r\nY3l+\/Tgehcy9SB55\/9n+NtiER860gwobAaWMaQf6aNdJLfmYmWsSqhVEZmP1pxxnyonpn4UwoseU\r\ngA4dtZ2DE83UF3hblvjUmH\/BeB6Gs9X2YpppYWlTN6P85GGIBl6p5WpOqUYZmH1dZt6YLGJ43pmV\r\nNgfgkxsliihqN7YW6aOLLrVlX30mR9aE\/\/XHnBDJnVlbkkmG5ySUcelzmoLAFYVlkPXZWSdmQ5bl\r\naqUswoqhss5pip4xM2zUw4dTknVXWjsGuWik5UU6JqXJvlokrbDO2myL6eV2qILV7miaa91B+tp4\r\n1kZY5oTNmXsurGfuq2GJYeGKjmmC8srom2BilvCpQ3K7p22xVurfrMn+mYuWMSrkNGWCVf4aVbyn\r\n1ksbuNaax++rEzdrrr4nQ5dUxgOGCGqvVlbWj5aSvvZlwiUWy5yl5WLqb78sgosUzD0QddV1I5Ll\r\nlaOjbltsnZqRBTGZE7Pc779Q4RoXxyA65XRh8qp158JmXVaWkpcO3e\/KGjoNhAqdUMludlpGtCDO\r\n2paHp19f+jxeyy0GnbLWehYM89cy8wqnk7YK+2OYac1WcoyX9qnkuX5uXetnT3YD3NK9ysxad6aq\r\nDTjPxNrZ88\/nUey557Mia2vGPUzbEM554w1pyaz74Pq8TykLe3+zq4wp6NEWWCDIINertsg\/QFfm\r\nfhT22Ta\/\/iZ75hD+zQ4Bfrjpeb0DCCOAAIIM66vvwgUddABBBB244EIHL7xwww4ouBCBCz\/AwAs6\r\nAAIMWIAGQHCBDFDwARec4AQgcAEIfOCClNDgBiB4AQZcsBIXfKAFG7wBDFpgPxfwIAgwiAEJhRCD\r\nGPiABz6AAQyqx7WY0O0nP4AABArQgAsEgAMyQEAEeIiCAnQAAQ6IAAQc0EMMQKABAHCBEDSQgP9V\r\nYAA0+EECPKAABdgAARSwAAYQQAME9CAIF6iABh7wAAvo7wEJaAEFMvABH2QgAxugwAZsQIEWHKAE\r\nQ4DBAFqwAUIO4AXPsY1kovWDApngBuy74AXVBwIUAEF\/NNDBDnT+IIMb6OAHOtABAIHggxjc4Aal\r\n9EEQfECDF7gglC10ZQxeKQQdvMAHN8hiEHTgA0TewAUxYCEPYKBKIfiglM1qwTFdSExAhedJIAmO\r\n48biwFfqIJNA0EECUfACHXgyfwg8ASpzCYNsuqB\/L7BBDH6QPxe0IAYX\/GUMgHDKINgAVsfkAQ9i\r\nsMrkOQd8RJsJEOCRtHZZ5wc3IEABQPAAATYAAkB4wAUsYIAHfMACAriAEBSggQ98oAIUEAIGHFAB\r\nByhgAQm4QQKqWACPboCNLRBCCx4AAQvcIAYK8IECNqCBA1jAB4nk3rls98wZdUN3MqMZDZwIAjFG\r\n4AMIxIAOMLD+QRe8QAMnGEIDW2CCEmgACCWwKlUNSFUNTFUHDXRgCy75zg18MAMxgEEJWjDCYPIL\r\nceCylTSKcZ26LAdCZiHZnrDXObclCW5CS1eUNkYzeOlHJkJqndlcdznKeMZPEuNTyoQ2JqREa2MU\r\n0YtrsokW1lFITYQhrIua5T1\/NgkgJPCQNBcUJ1tBdrK\/dCcJ7XeCEr5zXvg5bWCXJKutETU8zdvV\r\nicDCJeyNh5dj8cEOfBBKUH4ybbEpWrJq471Y\/bOGX7mhQyDHmrzwzTzAihCxhmWstT3HuxPznkCR\r\n2ymKfMwwtC2vqYQwPb4EDr3LydDDNvu5z\/hjsWw5GGCeGR7+CJxAB0IAgVmrW10gPLiWGMBfKDd8\r\n3R8ZT1wnKxqzCHexuS1tR4W5b34LA4QFYCACQPiARCOAgRZQEZEWiMBTLAABCmhAAxboqAYwYDKg\r\nDRZlzkztDj67NBzQxCuwecmGX5BNT36Sup4E5Q3G8smTZHksnhScipyVqcweFyC6weHzbCYilETO\r\nudhV02AAnCIkhWtzC4ZmQdkyn9SWRYMczuYPXvlKLQlPByfAci910AIdrPMpLgDqt+Qbuya9N139\r\nSC67LvIxyUQOAw3oAI1dacANxOACD7TAB17wgRYS0qMncCUFPrCBB99AASegdQkqxKzuooy7errY\r\nkknDtAT+o0iboUxJl4eU7E12Z85j4S\/OBnNM2FCKuBIDb0xiu2b7tuQ+nvYzbLSZ2un9Ja9nQU\/h\r\nojwj2e6lzygS83HgTK+zsCqwRkYTmpQ87OdJ002VsS2DsWvLF6AzBvlrZzfVmxbooOtIqF0385wH\r\nqhXnZ776sdYNuunJGGzYyuRmWLoFTNSgBvs2VFEuu7zN3IxjnM6Ye52YYcM2SymWcQRjlHoWTO+p\r\n9bzkgxUwaqGFQ7vI4AKapMEJRuFNpj+Y3F0G5SVbOct5IvoGKbnBREX5YB\/8wOO1zOYJvs7LXqoQ\r\nqDIN5g+A6mhc3uBLtVGlvm6OGhQ0oAEG0GEEdvCCBDz+wMIPaMAJslljC7hYpCdYgAUugAEhnCAB\r\nLh50kF0cgQZQ3vAWuKSLgYyBBQB5ARG4gRAsYIEW5BgCLUCpBhi\/gBIIYQEZCLI2\/xIVqsQrlC+Q\r\nwTVfMAr9bfKa2swfKD2ezQ5D2NHJpm4pQ7lVDkfK62tfOy+Z40lVHvOYqLR+3F8I1OMSvVAguJEF\r\n41mRjWP8Uiyx5Xmq\/+fisUgtLwhmc6ToHLuCfVkj9g8qn+WSKCEUARygQxXlRCjAATTWATrQRm4E\r\nBBsgRoSkahewAFJ0Ag+AYx+AARxFVSewAUAwZBuARxZ1AahkAQpgAQgHR3N1URqwAQsQSqWXARig\r\nARn+YGMbUEg88IFoZ2A7EAmkQAM04AI00ED8g3u+Z3CNBgRu1GgYIE7580kIJzwtsFv5cwM1KAQv\r\n0Gjd5HGvBASxBAQt8AEihH03BQPOsUxjqGj5BAO1Y1vDZhe5xF83gAIosAOtJGXI0k2fRG3Vcx5e\r\n5z0Q5hzJ5l6dEW1\/qANxV4b+wUtbEwTg04ioBRH+VwMV0AAWUAMRsFIZ1gAfgGqMx3giJWqet4Qk\r\nBAQxaEDrRFUW0Ea0BmQb6EkP8GMWdYEXZQEnMHobgAEfAAQZ4GMfIAQPcAI11lFUdUd4VIMUYDQx\r\n0Sk\/kAP3I1UngAIn8D8Y0FAERFVU9kAa9AGxZj\/+QkBrK\/QCCkBr9vNOtpR6n+RODRR\/jtYCV5hN\r\nMBBpVlhXtVRXCAcDIjRCJTBCLYBuRHcSObA\/k7USgSZ1ypaHfyghmQJKtLJ8c8Y9wrM5YYcmaGdM\r\n5FIujRgxz9KGYpEABlA\/0PiMsUaHD\/QDEWABVgUEBdBOtBgDEdBNCrBBuGg\/LBEDCWABG0BlrPYC\r\nOWZqG8BL+qhqLmCTLXACpScEeRSFXEhHJbABJbBMFsADNZRpV5EDF8AAFzA\/SrQADNAAMWYBlpRj\r\nERBTLZlHGHABFxVKbkV6GZBrWEdKERADWOV4dPRBNTZ4jLaBhGQ\/H1SDMaWPfcmUgOlCNbiGn7H+\r\nWHnzGstGFuRGJDZXZ2tjJORDNP5kXMkiPhO5Ik6ikTjwAjXQSvmDAj64cKHkgxjAhZl0SrYET7HG\r\nhZk3lJFGTypEi7YkQDdwhDzVTVboQTIUVyOUmxvHjsqkTD6Qj\/oUA00JXkhRNwhVgg7gdw2QAHc3\r\nU63EABHQRjQQAQzwQBGgAwugeBukk6XZAoxXmsAYg1hVg4X0i7o4UesUARmgAUvJlO8pBLuoAXO0\r\nlAzYlCWwUzO4lvz3fdH1PKEkFhS2FNejbOXkXtuFLPoGOwyKUMmzf3b1NuLDiENQbfw2AwqCA+qj\r\nSTuQS9\/0SjTwobgnTh+wYTDwSdokTrCkTQj+h4f5swFq2GpVpgMpenZO2Ha4xE8w8AHs5ANSdVPZ\r\n5wNRGAS4mR4Hdgo\/IANs1AAaBJ3YCXkXyJ0M8AAREAE0AHm\/eAElmXmPN0cmiYTTmHi\/SAEW9QAV\r\n1EYRgHQ\/tgCNFmSGF0YWIKc2FgQ2aZN9pEekVwIUIHrCpqFdsT+95Q8D+jPbOXt+YYiq5IWD9zOW\r\n46CzYYjcpU34whlARUPGFH1ngqlZUy5n9hUaagzX1QEheUnd5GzYdAJWh41gGBjetJi5WHzJ9qq5\r\nhGxc+COIFn8IxYWC5hyJFoXI5l0upG39+AM0EHg6sEOhBgTzg4oN1YIR0IJAoAAJ0HlPVZr+x\/p0\r\nP7AARClGqdhGCfAC23lHF+V5tMiF0UiLMrgAG5AArUZ6QrCfuzhHC0ABc2RqZ5acFNeZdEgDKACQ\r\neIhwwMdOnxR\/poRK8IRoRuqiHsdhLnR8WIZQMDR8FMlLu8RLobRKQAVDMaBPHNuxQeAC3MVgoxCq\r\nH6p7H4p1P8hlVkOEVGY7nfECZXJ8e+J+wrM2rvSH9rOOndF9ydNax6QmAEoDEDCiEMAAl5QA7doA\r\nJWlATnoCApAAMKiNDXhAEWVAvcV4CkCDCjhRxQhkxeMCCfBjMjUAMPiKGnCFpnYBK5gAJ2BjGVAC\r\nd7SU5ugykkEoYiGi3pRJL7CBSve2wNj+Tdioju8EA7Y2S6CkP5HmcVGoj3HlaqInBDwATA3Lm8DE\r\nA7AUQzAwTMsEA3HrucQkstGxZI+BJU8xq3LmcMj2h8pRiJc5O1yYSCzydoC4VsnhA0NwQkKQQjww\r\nBIzIL+OTkSVbIMZaASBgrM16Ab+ogQ+Gixe4hFvWAg72esAoR7tkk7dYgz6qA7R4ixtYeg04eBc1\r\nTEG2Vi6gABfwgSXApzHVrjW4vi2wlBkAYRviEnGBUAQEBEtVlg\/0QBtQkgn0hez6W7m2okRZwKJ0\r\niyCEi7xUihpASEOGAW4lUhtQSoREhsa5ajUoVzHVAhkAA0xZAjwQn42KaScGE+kXcpr+xBeI1CV7\r\nuJhaw6lI1k8acpDM4bv+cZGXKT7\/ZKE4vCHQIqooIGobdwKZZI0XZFX5k4ss2QI1aUvR+HYVyGrs\r\nGEwFN3ZLaErV607AmIQYcGoeR0FU+I4eHATvBJwpZJwpNEIjGzk7qKQ7EGpiFI3d9GIK4EouRlUP\r\nIEph2Ubf60Z2WophFJ4GZAGMVno3QHqKbEAcJUZAmgGntLVeZa\/vtIIWMK\/oiZ4\/JbSFElo6Uizo\r\ncW2DiJC0ohZBlW07oyfGhFiyOxj7B1AhJlCLZBc6AJogQKpI2JLXiQK7Z00F53ENyxJ+fLEeh4vU\r\npaqOtnYx1Usa1HjVZUrUpWUYK6P+RHpMyYG52ZeiPclvS0bLCcABTJsAOtAANKC8NHaJEVidOnCL\r\nL0ZjZlU9LgZ6iEZ6yruEEpwBC3ABPkABVgWnX\/xjLpABfofPrZcB8Wev9eoDFiBXCiC3LzinN+vG\r\nO1h0p1GoFJazpJUSjJt+\/lWpmEGRO0NDnLF2xCV3QaBCFQMr0VUxLXBCFaMqJeYPNSCqTEcUI0rL\r\nq0mogsZlCTRPzAF1ytYCP9ACoqcltXSioHRottSWCMcvYze5tcGdSHeDcgeyTCLLo0AoCAUBGtCc\r\nV9oAN9ABVuoCEACdU8VGCsBGC\/AAJ7WEU1WDFpAAHlSBLVCChnwCcppHY6sBLub+AzI4RyWYAf2s\r\nAXZEyTHArgoQe6RXryy4AQ+SDO1RKKhUAZkUSj7wjyi6ugIbf6eESrd0TCq6YV5nZX4B2o72sJYd\r\nSp3tTcYUzanEX8GkPz6wl\/q0ZX\/VHjnCO\/OGe18HLLRCSiMdYDArOBlCmbTzcFhdstOy1fNzAfX8\r\noe46jWCZgFLlPzRGgvbZAKunajcrMulVIo9YIX6RuhqyPNw802LBpECYP5r4AuzUSvbTt6bqhQLk\r\naA9EQm8bzNhVPHvIX8lSPMY1mZKJmafTzZs2osCySYKW0aR1kDRgcizUGWW3NoZYS4MhSmpnVy6A\r\ndRbuH8HUQhP6NlBJ4EzBOGL+0QFyyHgPBgGFnHgNIME9KXgv0IAbUEEX2ALV+bYXGAEgEIVfZ5J+\r\nTQEYkEI2xYXhKlJ6OoOF9AELcNJmC58hLIP79MAYkFdhEap6AYQocIBThYsCBIy9pYQPNuMG3Y0P\r\nDMGu+UAjVEolIHrxWwLr1JSf9EssZJxR6E7xGQQ3MFcyNFeFtAGoFIUxdd51sT+Eupif6nC1RG5B\r\nBeAQ\/rrRtlneBcsX2YjgE7QnhxsTTaBi+7TR+EA+GIRWVXAGJ3wznj8vFmvr5Eoa9E2uZFUj9AL5\r\nSLmeHVMGm8FXGFcn3UI3+MEuBEyx10L0+6d28QJ3l2FXSmOB10pV1GhupYH+E4aBIPRjS9hiEQBk\r\ns9mAZw5k8CnkD+R4D9CNH2SSGgADcxpSd1TB8utqhBS3RD10Mm1fxjEWC4c57CRfifgn0ZYSEwm0\r\nl+mzIC25ZNjasALLQgBQsHwbaGYMGHRKN70SdKxJ\/oOHIPB0qcl7CMVxoaSEEcADT9FA3vR1uOkC\r\nMVhMD5ABLJJ6piSj78R9zsEDRHbaKeRNudgZKWbgP6ACTHuJlnTiVTR406gAZtoA1Jk\/VaQAr\/St\r\nfneBkFeSXsdjbTRoEJCLIPAB\/AxUbPTgTnzJ6tuAeHRCTiy3cIvPsYde\/UAampT2NP1gBfl7yZbU\r\n\/v0URxhdOwpt\/f2QXkf+8CT9JcVUMRd6u6usKq3Cj8mA5TrQAUw3CpVNbjswqNfE9j7i3tUTAzW\/\r\n1MzBA6jE6ECVP3ruHDcAn3LX0skhwkMQA3EbA4BOkV9nLt1XwiS7g8bQ6RgAAgZI9NV6ojoQpVba\r\nRXqc1mkNAjcAAW30isNvAZTIz0Bgr2wUaT4megpQAUT9A330dgbEHLDn9XILVPGL+T6geKRn9lm9\r\nDNYFci\/QSk23S+WfS3h4TS+KezSwo57U2T3AA+8PoqhET0Dldtassb57uy9UdoDg46Mz6MPjIyQo\r\npAMkBAS0A\/m4s1OTQ3kD8kP58wPEGOmiE\/koROPz6OITJLT449h486P+0wqb6hhU6vLxEsRqk+Ei\r\nxAPjywrDMyQU5AIjVAwUNDTUEoNoKxlJWUO5QwMB1AER0YGBUR7RsHOycGGBcQHeonCBoYFhoaNz\r\nrwGhsQDBggUNFGj8gJDBA4UKH4R8GPDgAyIXBEq0sPBgw4YSQ0psoOUjwwYNGTJYaDHEhwWTjLBN\r\ngjQDx44fN1AAofHiBQ0XL274fLHjxgkUJ17EcDErp84YL0a1uBGDhg4aJXLeOHXzhg4YMGgMsxHj\r\nBqogPIJA5YEWkY8YMZahtYYWWRC1tIB4mtRtx4xNlVyg8LTpERAVRRk1FQyrU65HnoTcEBK1EdkX\r\nQ3LNReQrBhBBiHr+RFtWWVmruYmSCRkSo+y00bUEu9bGrRuCBBEiXEBhWwcKARginXtxwp1NHRc0\r\n0bx34YEQgRReAHFBwQUEDxc+WLB+wcGPEgoolCiRoUIJDBtatIjWggIMHwtEwui4QON3jRQstLr7\r\nktKMSztygIgAAQc0oECUQSfQcAMQwH3gwgnlAGXBCzz9cBIKLjxHA4I0mfBBVc3AAIILNpiwGQ0w\r\njGiCC9C1IEhbRmXGFis+IMNVXDC09YpgpGwj00ydfCKLjozpcFdLiWzGCk3RGOPLaI2MZlkrn+Uy\r\nWjKVsaIMZogoM02XW7ayWilCarMXJhwUV8AFQDSAgg4voAACDR3+XAWCBT9g0AIEEnaA1AM\/tJCT\r\niiC04IJBGoBggg03fNBhCzB818OiJpiQgQ\/fXQpDBh6xaFF55V06kkcaNOKajpTgINMPLtQ2DgY0\r\nXBDBgB80cAIGFkLwARDRRXCOQDtgoAMIwTnwQQeMYuADPze4sFEJHZpQQg8wWFCCCSeq18JGXD1q\r\niKYUOLqtpo6O9JhLec3AyUzdEBlYJEL8uIyYpMLy7l3OsQKlED00VkprvnwGBA+1DCzaMk2udhqX\r\nyiw25jZ5zdRBAhagoMIOMsggIU08uSADDSnOeMFVOVnXgokgLMugDzYgVUIFwHxgwweJ7stwLcZM\r\nuUy++OJM6mL+pEDicF6qRpTAyRU8AEIDP3iQwAVHf+CBAyHiikF0cFpAwQYqPoCBRBRQQIwGDHlH\r\ngQYwuOALfjjbDKU0A+8cr0tA6\/ew0J1screKP96l9iNMCraKYDfbEu+SruF7GpaJuz3w2448Xurc\r\nOFyCNyUXSLXDKJlo7KOKJyb4iQIf+HQDD55l4tMPPvSwciell2CDDT+MLkgPPaxyCA82rEKWIMQ0\r\nyXjcsDC8Yzfo8tWJDBzc0PU4F3SAUwIN3LBDAhtcdwIpFrhwdAImyMDMyfZoINAGYX2QwAcgMFQd\r\n1B+4LMQ\/6bUQxAYUuKdBCyX4UFm+tjDMmHMJDROUoMEJRsH+iQu4wEc78MEPYvAjIPhEInZR3SME\r\nIYtNtOIoqvMEKgSRC1RMSRozEo00fDGEJzVJMmLKBWBOha66Pe8HIHAOu+5WwVn8xRM3kAFPUOEJ\r\nFzzAIA2chQQfcKEP6CAIEYzG4cpCQv4xiRVz8YUhDFcqwPDlErHpBg0h0AEAdWCMFojAdc7BAXO8\r\nAAJI\/MEFNICACszJLjcomjsqwBMhdA0fFriePTAALWh5pAQ82AAMyiOXkrQgA2XRwAeapQFn5chv\r\ni7mb8ewmAyL5ZAcdAAH0MhQUBFEPBBfohO14AARFVdAnVOFMEGzwiUjwoBmniNRm0mIM3kFRYCj8\r\n3WUSYbD+LHbiXDLpEcRscgOd4CcIRBqSLBzImBLAwC6H48VcYCAWy5hFGFbsxWkMNg0USqMyvFsN\r\n4qRkC74N81Q44MtMZJAAMELgNrhiFA044AA1uSB95MuVJx7QAYZEBCk9oADUMMABEHzgBB\/QgAxK\r\n4AAPeAAEGBCPBoRRgvxloBgaGIkhNbUBY8gtMYxZZ39iOMwf+FAGPdxJDV\/Qgh3YoGg+idMNbGAc\r\nIHQFBoy6SipdwAPS4YQGTDHdC2K2O7SszBDIgOIh0YKWKlJRSgB0jUn700UvtoldkZPgXd6VOR\/9\r\ngBkS2dkjrjIWyVDJZjbAF5bCKZr+mbB\/VP2bVdeJqsn+PUwGDRgQgWqIAh8S6AZpjEQENlCOHSoI\r\njy4wlgsSdNEUqcgFJajhLmLXgkiC4DtHaUFZPJKpz24qsxYhFSWdmEN16ceYlLiYDAiEgg\/ACQUc\r\n4ACE+kpDnrxgdJ7YgYo+8IDvJegDGFOoCTbLCwt44CoweMGjwOUCRwXBPDygXxDAA9W41MWqgrnb\r\nJmSSgzK5cwcoCFJJzQKYZqoOmqjYgU4kiCTXBc5gOSNNk9gGpi7pN5yJG5jgulvSYU4OBzVopxdv\r\nwAAQzDZDNLCBDHDgAhDIQILGgkeCOvHGBnMsgxAAgYNFZAOdTMgEy7IBD9jCFV\/UiJDTPSRXpBmD\r\nfx3+TnBpM2U3cDCDHjyMsCiwQBiDsz6XveABELhBDw5FUQ8oJkQuiBqDNoGBmJmAA4z6QHJO5rRH\r\ntoA8z60fIVm8gY2ixbProW\/OAOxdvqCqwF70ojp3YIK7yACHF7ybLBqYTQ\/2LRq7C6HAahEaFO5X\r\n0Ai7L\/D8tqS79SgHOE4XJcIx5xr4RB8bujCTSUxNDyDAJyyl3iOWRzocsO4HOwECiVdHDEWQhRgs\r\nrlF1m1rfxWCDiTnc141jeCqaEPkCtRVHAzxcAQi0lVhn8kA7n0OBmFHAASbY1wsqAG0QRLICDtgJ\r\nB7zDIQ88KwNtHUmmggADbFvryyyUsQstk8MfFBP+VTFpM\/V4204PM3FSptxX6gATKRsUo948IBET\r\nfxDns8KSiVPsQX9zphoT3let6B5rmlW7g0Y\/DG\/q9u6+SpruNAc4zfvaV5prbBeRavNfOTNz3Gjs\r\nxDSzdnK4xoEsRN0Dl7ez4\/U2pepo7nEH4tx2tvsBzyNl5Nv9PJeHkKpIwWSzm43835ZUd17bfSod\r\nV9ySYmVMV\/dGzcjloge0FlzhWHOwpIM9cH7DhTEcznRbR5zdxqxcxNXNCRswgFET5XU8KqDtG1RA\r\nBjZQkwM67L6E7KsAzH6fCSrAgSBcIKOroJZ4NMKiMMf4kAv4ACNRm26m+7wT62Z73b6r2h\/MgGP+\r\nHdC2thFf7B3s\/QYX6IHySIwobTdbfVXmEAd6kKgQ+cC5XAHLKtYCQUPEDqjojkaa77YvA6+9Bu1m\r\nraO9eNe+YR0\/attbE2nNimgUDGGNQ2E6Rz1Wrh8\/4uzEsfPVBXextnPmala0z8XKcYvL3+GlAJ6Z\r\nSU5jVphAAw5VDPLdn1ds1yPr9jAyYWucB38x51074HE+4nE293HY9y\/Ac05nVlXSImrz53O2tm7M\r\nV0x50XYT105TxxceZ2AQyH4a6H9jhWhU5FbodjOJVkFp53QmVUweOIB10yPr5HaogjceR3PHl4EP\r\n+IBaVHYq9HUARnDH93Cgt3aMNgMqMGCXgCr+a+dFPjgTqaIuJ7iAFVeEm7d5X0h\/PINFLfhvNWZz\r\nyTdea8duM1BgAfiBMVeF5Pd2yjde6QdxKeiFTMiC8qJ1mnd8QchATrh8JBATcBiATqeAyncqN6Z+\r\n7vRdAraFFAeGpbIYXecJgHg3\/5YqBqaF5YcqhniIBIaIpZhX7KRmA4iHd5gue9hEf6iJ\/7d5uTaA\r\nxtSBIsACHlgDu4hjb2iKiEiHdGiLa1hxjpZS3mV1L8RAy+hoxYSA6+Z0BDYBLMACK+CGblhgbxgT\r\nMzCKwJhXOcBoVfiB44iFdHiHfPhwdZNrN5aI4rhmODCN1EiN3IiNzMeL7+iLwBiOAWiF6+cTdMLI\r\nCW6nRcaojgC5fuLIjgEYCAA7\r\n",
        "names": [
          {
            "namestring": "Podogymnura",
            "identifiers": {
              "namebankID": 2479441
            },
            "pages": [
              15393041,
              15393052
            ]
          },
          {
            "namestring": "Tarsomys apoensis",
            "identifiers": {
              "namebankID": 2481403
            },
            "pages": [
              15393041,
              15393069
            ]
          },
          {
            "namestring": "Urogale",
            "identifiers": {
              "namebankID": 2481844
            },
            "pages": [
              15393041,
              15393051,
              15393052
            ]
          },
          {
            "namestring": "Limnomys",
            "identifiers": {
              "namebankID": 2481054
            },
            "pages": [
              15393041,
              15393067
            ]
          },
          {
            "namestring": "Apomys",
            "identifiers": {
              "namebankID": 2480863
            },
            "pages": [
              15393041,
              15393042,
              15393070,
              15393071,
              15393072,
              15393074
            ]
          },
          {
            "namestring": "Mus vulcani",
            "identifiers": {
              "namebankID": 2481191
            },
            "pages": [
              15393042,
              15393062,
              15393063
            ]
          },
          {
            "namestring": "Cynomolgus philippinensis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              15393042
            ]
          },
          {
            "namestring": "Tarsomys",
            "identifiers": {
              "namebankID": 2481402
            },
            "pages": [
              15393042,
              15393069
            ]
          },
          {
            "namestring": "Maca",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              15393042
            ]
          },
          {
            "namestring": "Mus todayensis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              15393042,
              15393061
            ]
          },
          {
            "namestring": "Macacus",
            "identifiers": {
              "namebankID": 113836
            },
            "pages": [
              15393042
            ]
          },
          {
            "namestring": "Cynomolgus",
            "identifiers": {
              "namebankID": 4133912
            },
            "pages": [
              15393042,
              15393045,
              15393047
            ]
          },
          {
            "namestring": "Cynomolgus mindanensis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              15393044,
              15393045,
              15393047
            ]
          },
          {
            "namestring": "Pteropus lanensis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              15393048
            ]
          },
          {
            "namestring": "Calcar",
            "identifiers": {
              "namebankID": 4098691
            },
            "pages": [
              15393049
            ]
          },
          {
            "namestring": "Pteropus",
            "identifiers": {
              "namebankID": 2477193
            },
            "pages": [
              15393049,
              15393050
            ]
          },
          {
            "namestring": "Natuna",
            "identifiers": {
              "namebankID": 4507888
            },
            "pages": [
              15393050
            ]
          },
          {
            "namestring": "Basa",
            "identifiers": {
              "namebankID": 4087873
            },
            "pages": [
              15393050
            ]
          },
          {
            "namestring": "Urogale everetti",
            "identifiers": {
              "namebankID": 2481845
            },
            "pages": [
              15393051,
              15393052
            ]
          },
          {
            "namestring": "Tupaia",
            "identifiers": {
              "namebankID": 2481832
            },
            "pages": [
              15393051
            ]
          },
          {
            "namestring": "Podogymnura truei",
            "identifiers": {
              "namebankID": 2479443
            },
            "pages": [
              15393053
            ]
          },
          {
            "namestring": "Mus rattus",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              15393056
            ]
          },
          {
            "namestring": "Mus everetti",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              15393056
            ]
          },
          {
            "namestring": "Mus albigularis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              15393056
            ]
          },
          {
            "namestring": "Mus magnirostris",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              15393057
            ]
          },
          {
            "namestring": "Mus mindanensis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              15393058
            ]
          },
          {
            "namestring": "Mus kelleri",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              15393060
            ]
          },
          {
            "namestring": "Bullimus bagobus",
            "identifiers": {
              "namebankID": 2480894
            },
            "pages": [
              15393066
            ]
          },
          {
            "namestring": "Bullimus",
            "identifiers": {
              "namebankID": 2480893
            },
            "pages": [
              15393066
            ]
          },
          {
            "namestring": "Limnomys sibuanus",
            "identifiers": {
              "namebankID": 2481055
            },
            "pages": [
              15393068
            ]
          },
          {
            "namestring": "Batomys",
            "identifiers": {
              "namebankID": 2480884
            },
            "pages": [
              15393069
            ]
          },
          {
            "namestring": "Malacomys",
            "identifiers": {
              "namebankID": 2481071
            },
            "pages": [
              15393071
            ]
          },
          {
            "namestring": "Peromys cas",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              15393071
            ]
          },
          {
            "namestring": "Apomys insignis",
            "identifiers": {
              "namebankID": 2480867
            },
            "pages": [
              15393075,
              15393076
            ]
          }
        ]
      }
    },
    "1995": {
      "biostor\/65542": {
        "_id": "biostor\/65542",
        "_rev": "1-ce613d67f80415aa01698ce6d684a245",
        "author": [
          {
            "firstname": "Luis A",
            "lastname": "Ruedas",
            "name": "Luis A Ruedas"
          }
        ],
        "type": "article",
        "title": "Description of a new large-bodied species of Apomys Mearns, 1905 (Mammalia: Rodentia: Muridae) from Mindoro Island, Philippines",
        "journal": {
          "name": "Proceedings of the Biological Society of Washington",
          "volume": "108",
          "issue": "2",
          "pages": "302--318",
          "identifier": [
            {
              "type": "issn",
              "id": "0006-324X"
            }
          ]
        },
        "year": "1995",
        "link": [
          {
            "anchor": "LINK",
            "url": "http:\/\/biostor.org\/reference\/65542"
          },
          {
            "anchor": "LINK",
            "url": "http:\/\/www.biodiversitylibrary.org\/page\/34572132"
          }
        ],
        "identifier": [
          {
            "type": "biostor",
            "id": 65542
          },
          {
            "type": "bhl",
            "id": 34572132
          }
        ],
        "provenance": {
          "biostor": {
            "time": "2013-03-11T16:33:31+0000",
            "url": "http:\/\/biostor.org\/reference\/65542.json"
          }
        },
        "citation": "Luis A Ruedas (1995) Description of a new large-bodied species of Apomys Mearns, 1905 (Mammalia: Rodentia: Muridae) from Mindoro Island, Philippines. Proceedings of the Biological Society of Washington, 108(2): 302--318",
        "thumbnail": "data:image\/gif;base64,R0lGODlhZACcAPYAAEdHQlRTTVhXUV5dVWBfWGRjW2hmXmloXmlnYWxrY3FvZ3JvaXJxZnRza3h3\r\nbXp5bXh3cH17cn5\/eIF+dYB\/eH+AdYOBdomFd4WEeoiGfIuJfpCMfoiHgI2MgpCPhJCPiJORhpmW\r\nh5WUipiWi5uZjZ6ckaGej6Gfk5+glKSilammlqyol6WkmamnmqyqnbGunrOxn66sobGvobSypLm2\r\npby5pra1qbm3qb26q7+9scC6p8G+rcG\/scPBrsnDr8XDssnGtMzJtsfFuMrHuc3LutDMt9HOu9rT\r\nt9TRvtrVvd3YveDZvtbUwdnWwt3axd7cyePdxejfxeLeyeTgxunhxuXiy+vlze7ozfDpzubk0Ovn\r\n0e3p0+7t2PDn0fHs1PPv2PPw1\/Xy2\/n03fz43\/f14Pr24Pz64v\/\/6gAAAAAAAAAAAAAAAAAAAAAA\r\nAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5\r\nBAAAAAAALAAAAABkAJwAAAf+gFdXWISEV1GEVIVYVIqNjFiIjFaEUY6QklFWUZqcmpudoKKdn6Gg\r\nh1ScqVFLjVStqUusrK9LR4KKjIKJibmLl4+MuY65nIRWyMmcyZujysugpKCujZ6qrpaqS7aXuoOF\r\nxOGVlI+ZkV2VXepd0sif7qXNy1Fdo53UVFDV2a7bq6xKjiwydGXYwIHdIJ2zog4ZlmbMIopSJrEd\r\nPEvULE1JtTEjJyitbO0a5IuSOkFXTKpbxkgdpGQN6yFbyU5TvXcTYZoy1chKT0\/YVAGFos3WQUL1\r\nZKaEyXAdQ03HHsp8R48ds3hRpFwNRQ8rRozNPGKslmqVUUUoC3URlHQQJSz+Mk1Sojep6bq7TfMm\r\njckUIsOIVKJpwrYRKLUps4wS\/NbwilNKc2PKdAmXIRQom65sa0LUiSdQTUJLeZL1s2B3WjZBSR2X\r\nHZaUjqs4gqVvSUBwgmzenTwzJr3ef614CWHAwosTKyZoOBHiwgQSHHi4mKDDxIQFIIpMOKHihA4Q\r\n3GnMCIFEhwcVLl54GKJDBhITJ5CAqG7iggwZG3SMuADjBIxXAhXi2GRJaSEZb1X9lRRDRexAAw9A\r\nBDEDDTrs4EMPOthQBA86WNGgDjo08QIPRYAI4Q5GGFFhETP4UEQRLyBRBBBQ+LCDFTswoSINNOoA\r\nBBA6FNGEDwAusttdjgX+15BdMzXZhYFeeAFXF158QaUXXVjpFF5YHmlgQ19YkZqWQLwQAg0uGPHC\r\nCjpAUcMKL0ThwwomrFBLgEjtpc6XYm75WF9NwrZUT8zcFNFvoNwUWCmLSsHJkDS8wOOGlPIAQxQz\r\ngnhEkXmuY+CXWmjh2KcNQdklXkv+BcZahdp1U4IMSbkSRE96IsU6WH7Z1qupsbINnpKFKuyTyaSW\r\nWjIVLohpF1QY8akWXtBwhBfIePGlEzyEORMSSWCpQ7ZIGLGXFkZAcVIXOxDViaOOguJoFESBlAqe\r\nUxarxRZXiKpFFqFakQVM1h0AwgQdOODABAo4oAECHhgBAQJFEOAEBgr+iIDACFEQgMACHDO3wAQR\r\nJFDABwHooIIDB1wQggMLRGDCDgcooIVWUlTBiRQ4swvvZZZso4SRuz3LmpjI9NoFDzyYYKYK1Tmg\r\nwgvw6SDFCTtE0QEUO4Twwg48WHECdR8jrQIM8MlwggZBDDFBAye8MMMJLcAQhAdAdIHzTFot8y68\r\nvnKKhayiZpHSFltUccUWUoTxxRdgROkFplo0IYYYX4hhrZVOONEEEpt3wTlmk1Nexhla4MBFGFo4\r\nYUQYZjwBxhhhVCFF5aFBIYUZ1jaRuBVEDUGllVRI0ZEUPPvMmLCHI29FGCSEAIIJA5ugQghSpKyB\r\nCyCAIEIG1EdRwAL+ASyAgAlAgHDABBmUkEEG+3VgAQEdhGBFCACk4EEAH4BwMAYeJEHDABP4QAQ0\r\nYAEGXMAD3NGBAERAgg5MAAi8IwrxQAKvAN0FWvnK1xa0kIQRTGACGwjBBg5oAinMYHoD88ALCHYC\r\nKVyABicYgQp2MAO3neACERDBdkSQAA2IIAIZkAIPQDCCCCggAyZgwNcOAAQpuEAFIjCADETgnALI\r\n0AgeWMEHcMgDu8HrXSE5AjqmtJZc3WuDVuCCD64UhiYIB0q4opLnbgWFyUmhSlYogxekYDkz+PEL\r\nWgCkE5JRBTOIYYNm+MIYvqCVKEFrC1wIFSMxo4WHPMQKe7tMbWz+Q8Y9CeteoapCFYilhSpYi2ii\r\nTMa\/tsAEDjygAS2QQQZOUEMaJCECN9CADVzgAgwwwQoJUIAFSFAAELRgBilgQSxb0ISa0IxmmHxm\r\nYBwVPEtoEiQ+69SerPVJwh1LWFn4F7+K1qssSCEGFqBABiTQgAhMYAQUaMIIPuCBBShAAQdgARQ6\r\ngAQIRACIAShAAzQQAQdQgAfU+hc0tUI0ZMiumjhLhSZZAYWfWctTXHgSFw7nL6Lxi1+pyUIV\/HUs\r\nMc2MVHazwhYAeSVqZckKSJgCF6oQyS80oQc4MOVFZ4bJfUUzNQvNwhRsJoVq7gybnAzak4RVBW8u\r\n1Vjf\/JdPtRD+hX419EnmfNaekBHJkRYrSg4tWtHecax\/dSELn2DoKiY6hSkY5YJdgtZFVSqsDYYK\r\npP3Kq0mhmld8gZKb9xppFgq3lL2KqQol7Shik8FQhm5iH\/BawhSg4AQl3MULg7Drs7yZ11DlS5RS\r\n\/ZdDQypaMdWscMJpZhee4ITBPuEJM7XCSEVJW0KKkmaphGY0s5Kzy2TOrUr42ZXQwc0oUQlaUHLq\r\nJ5fL3OWGYQYtoIEyrfCBumWABSOIAQosUAEceEFwIG2qsZAxTkJKBBmrIB5FQVLRy9pVcHZNnmcH\r\nu4XBGguxoi2lbBH7SS4QgQY\/CPATmhAEKRABCQH+AQ5mkIT+wjU1lbIVKYTDigyGauJd6l0vNi17\r\nqnydEbn25YJKrXCFwTa1vExNSV23cFguVKlKV+ACGCAZY8KBYcagReNoEzvUYjE2K9OMlyankDnL\r\nylGuT3oq4ayQBC6cDgxX8EIYtmBcLuBMCyL+grVoO2Vrdclx+50x4arghCuAYaMi1TK0qjCF5GFp\r\nrneDQq5WkQ9HXbO96nDksEJVOC40QXszQAELUACCFNigBC\/4AQiE0AESuGAEKRgBDraAgxuM4AU3\r\nEE8KSIADJLDgByQYQQtSIAIWIKEBMGgBCqogAx6kgJc12EELWAC3FqigBCRggRFosIMSOCAGIZCB\r\n7L7oW03+VjZKUR6ulzfIbCTg4AczuAESagBgHATBCD9gpRCIoGARCCEJT2DCDH5ABCEEgQhAIIIT\r\nflAFAs+gB0CowRN2IIQe7GAITWCCC3DAbSkYAQn47sEQgrCDFyShCDuSwQfatNs7KwHP6qBylKmM\r\n5TNu4cZbCMOUNQ4GLQSBC1l4whZeGwZwP0GUTgikEZhQBiIwoQoiHQITvvADIzS1CU6OARMGHIQq\r\ndDBzT5hCDX4AhB\/04Gcg1bMW2qoPpl\/TNlLC0t8+Cd\/DhZNwHBWpFpAgAhhgFwUeyEAQbtCB7Iqg\r\nBCmAdgq8MMUY3ICXLNA3Ec4egxlUAQc4GIELUIACIkD+4AYxaEEQSCCDCI1gB2Ao7UZ8YoWOOP2a\r\nTkiyFzY42CcRzr73GqyKRVq4ocqOyE4QZdCH+lrEwvysUt1oGhsvhSw0gaYlnvHhEl\/i2l89nCmZ\r\nrWwb39ZGtHWymlRC1LtAOG8Wn+rHB6Vm6cuFy2+w+YSLJPSTHCrAdiGSxUeJ1WtfYsMZTvshRe9G\r\nfk9+4OMZs9ysb\/HrO1iQh\/P9Ig0nzOMPf9w7v\/In8eb7WTx\/9r\/f6lcHcoIAXiJlWwVBBeQnWUvg\r\nWxYlR9bCbOs3U1KwURfXfpNHU5AEfdFnZiMncszWepMnfeoHSWMGfyIXcq23BUoABCiYBVywESKG\r\nDFf+4ARQkBKXITxtRYOahGxydTicRVNEQHgo0AIxICmcQwRPMANK+AIpsGBNYAQlEANuhwIncB9w\r\nYwMskAVE4AJVQAIxMAKrRgIlUAIu4AEjQAJZEGpPkAIlkIUkgAEokAIggAIVQAIo8AE4AIUp0Bwa\r\nkAErQAJJwGaPZ1kSZ3nrh2VcsG5JMARI0AM9YARJIAU7p2BIwATnhgRVoIRGUANEcG35NgRG4G9Z\r\n4ARBkAUwgG9MsAWvJgQ\/AAPwVgWxVgX\/1QNb8ANJcAM18AIuoAGuCAPcggM0UAPCCAMwUANR8HuZ\r\n41vERXzHR3GihGVZgIklaDgvOFjWKFOsJQaVyC\/+\/iYFW6A7PGAEieiCP5CKT9ADQfAEIhV0Q2Bw\r\nr5cFqYgEoRdgQzWKKWcFg+SIPVB+bbUzTkBlUXeIYPBnDeQCIlABMAABX6gB3dUDdrh3XkgCRGAE\r\n3hYBKFACI4CFI3ACHDADMoACMVACLWAEFSACLoAEPgQCFXCGQkCHDMR3GOACNSACB8l3PvQBJPAD\r\n2EMESbQBKFADSkB+mrQEshKQhLNlScAEmRMuTWADmqMjTpAENSCN8FgFIndy6mhOg5UzgQRyYSBj\r\n3edkICdyM3Vj8+eBTvYDTjBTDyZKU6AvbGY45adJTSBXjnSIXMAjLleLQiADTtCJRBAG2tUDT5D+\r\nBETwhFbZiaFRc1kABE8gBflGbgcGBDsgjExABD0wAgfmiz3wAkHQA0IwBE\/QAjuwhUNABCyQBGnz\r\nA0EQYEBwIT4wBY0oVFOgBDoIEsY1eesHSa30ASUwbkzgkoTmAltABDPQAb6IAi5QAgqmACDAab5J\r\nBDaAAzkgAzYQA4NGaCTQXTsQAypQASqAA3YoBBVAhx8QA0iAAh3gAnYIAh7QA3w3Ah2QASkQaTPA\r\nAkrQimzmBERGl1LyN+tHXyT4lVPmZFkwZS74ZAl6OhrXes0XBmTABV8goV8QoSL1lWRwZhp6Yxx6\r\nZtHYfGAQBmKQeBh4cU4ABkZQZliHErQplLj+GWW6iXWXdwNKSKOBaQM\/kAUyUAM2UJ04lwOuNyE5\r\ncAMsgAM2MANHmm1KmAI5IAQsMANO0AIaoJxMUHcfyXcwQAJGIAPsSQJE5ALXyQLwhpBIEANgwAIv\r\nkKYsYIc1gIyP5zjMGIFPwAI3kAMzIJFPYANIKGg2oGpN4AQ20ARP4AIyYKSV5gI0gANFakItIAKb\r\n6QJOAAQ4UANQGgOI+gLKyUt5CgOWWgEg8G675IgmQAQ4sAJPkIsrsGnFCAP8+XsTVGZXAqBe0HwJ\r\neqCn034ZKJZfWV9cAFse+gRi8JVVQAb15QRPcAZi2TgFCnNieavFCnJcQAYu+ARGcKBMcGP+Llhf\r\nU1BfQSk4RCaITxB8yBUldnV5YBACNbAFN8AF2gWma1qkXEdoQ1AFHVCc+ZZdgYcCMhCYbkcCqgaS\r\nePcBIiCw2LadU+pDk0aTJbl3KkmHIMACWwADKLCdSFAB5TmH5NGi14Rss1p87aeFoUcEWogERGCn\r\nliioP+BsNKWOJ+d6QvAEB4YErhNOTLBzTxAEgqpvOXByTkCyIisEnDNyzhZuSBCN51aORssE+xgh\r\nSoAEQRAEc3kZS\/A3WLKbl9eyvBpOr0WbLuiCU3ByTRCNEuZgXPADQgCP5QhbAxZua2usWps5Shm3\r\nIaeOTcpaXxsErdVaTJAFQaADjWibbTX+ehOEBRIno+3nBB6AAiPgAB0wh3wHduVJAkM6sXY4BCXw\r\nAY+LBC0wAunJAR\/wAyPQA0F4kF6KAY0rAiCAAygwsB3AAQfZAXwHAgnQAxZbAR9QAbRbAR1QATXA\r\nkHUIAxZbBODKZpSVm+QaoAY6f9aYvO\/XVE4GBi0LcwEKSYk3rddqTtF7dbL4flOwfziwls0LclOw\r\nc1dQm0pgOL\/1e3ZLZNACoBZ3eTvwA4XqBEOQYD0wdGKAAzBgA3k6AzlgtkRABHcHmvaGd0hwA6zp\r\nAjhVA0EgBE6JAu9GdDmQA04gBDgwBI4oKU4AA5eJYDXgAjBABMJYAynQA0UwjETAj5P+5QRRF4IR\r\n2ARlR6gVKwKzNqUokAV3igJI0AEN4IXahQJC8IU0OQIb8AGBlgNEMJxzyAI1AAQMJAIyEAM0gAJO\r\nUIedWgFiirsqUAN1aAJTCrzbWQNkswEbAAMnx48c9ki7OVgRSgZmEDsu2MYueGO0igQjunFfeWYy\r\n9qDPG6x0PFNaeKAhKmNhsHMhCnN53HxbO8d+tqFtBgYq7FvoF6e82qsgqZwyUKRNwHdfCF0kAAPs\r\n2gE\/gAI3oKM2YAP7SgQxoJZS6ALY6b8g2QReyAHYGQMgEAMfqW8uMAO8hKQgILoV4AJMUANYKh8w\r\n4JNZynfs9lqT1VbCJyoxenl+5gL+TYoDrIiEq6zANNADOYADNSsErJijQxCaMhuNSKiErGgDABfA\r\nTZCHTIDECqZgQlCzOeCIOOCIU8kECtaz96uWPdCKQFAEPUCM5xu4vwcFfzNxzld8ZEAGTNDGYtnQ\r\nM\/UEYbCgZPCVujoEMiA5ThahHKdxBqpxZLY5Hn1yzarHZ5aBQpXSbCZjonQFNEV+WJk5VEYlENh+\r\nVaBMdeiSo\/wB24YC+WYDXDAELXDK+up2ZNCS2kWqFfCRg4oCFpkDJPABZVqeIsB3JcsCeycCgMqe\r\nulu7FbABT0ACIsB1FRAEWUrGUEqbo3cZMOo4N52IopkFQLtzSCCzZDaWYxmNQrD+OTQFcj0bcnjd\r\nq\/w2YDXbbkj4p1a5lNuoOkrLAjcrj0wgmzF110+gBOcWBIEo0yv8ZlRrcXLtBHa9c0QAcoxos4Ia\r\nwDArssUp2nsrBKLdWpU4BM2nlk0gBFXABO38p0wwUztXs0gIj7odBJzDBEXrtKIbjUpABKopj3F5\r\n0MI3cXEKrU0gsBY7sR\/QAC0JAnNnhxXQoxyguH33BFKoXUzQAQKLAMFpsUaAAxnwASxgAT+gALfL\r\nAQvAAeRdATNQATEQzFy3u5FLsShAxmeNkCgQAhabrqNHvFCALxwIZR7rfycWTt3bfKJUbrRaOLAl\r\nou6X4UTgjTBHU1YJczfLljv+AFuGGU6A3KtC1bLx52SySVs5eHRtxWY8+48cCEnW2LVD98\/\/\/AM5\r\nUMgxoNGk+s854AItsAVG8M8IPASrbG9DgAI90M7jxs1XMAM7ICHkdgNBAAYvMAIv2wMusAM7kFM2\r\nIOU7UIxlLoxCV8IrIMY1sI9DVX4nOnvOB61MMKXlubogoAFOgAMJgLpIkAIOC3bvrJzaJYZnDpIa\r\nYAQ3gAEaIJJnS6S8TAJYDqlfTgJOcOS5BqmXzAAjoNUxsAM6bAQtYALOI7EpgIn86DpYJ2aJx9DM\r\nqqEVfdEZR8h7W18ap3EjGq0ijaCwczpjEKyGFAZlMAb44oJl8MaQBKEhCgb+F\/2CIVrhz5usN1Z6\r\n5fdau4Ct6ue1OEDNmBvAKHDKvKTOTrqzYFiOQjDBsIzkFdCJLsACcccDE4udOWAEcSgCPzCdo9Z3\r\nezcDQhDvPikEXvcDFeABRDCl8Ml3JOBoG8DqX4uMF0e4VltfM1CJC1aJYEqdF8wEz8ZuP17B5cYE\r\n87zuN0CLoZlTO2Dp1AmPLvADNSDaRmDBPSCLQpAjCkZvJJ8Dwwy0wtiIA+2KOiDnEZ+D20oIzedk\r\nu\/m83RuhsCXRKq5xIdfIX0nRBBoGM4YETiYG6tisr2UG79esXLBz7ndm4VatIRf2IDeC7BeXzAx6\r\nN0bxS18FMVDWB\/nuNHD+5qgbAz2QBSyAunHeukbqmx\/QApgbnD+wAxYQ7x2AAbfIAiXgug3\/aC5A\r\nBLDrbSoJAhvgqXQIA0u8ugVN4Sps0G2FBVCmm+TafDM42aI9r6\/1BHc9BTY3kUOgt0jYsy0J+6GH\r\niaSolOZmBX+aIjFLspjYiTLbiCKcJuZm3E+LYEpA4YL43KT\/WjgO18UHfckK0ta+xxzqZB8doWJw\r\nOrMaBuPvYhr3YouD9TKGcYncoX\/cofhSX90H03FplaOXg\/9IOHLf7YbL9iqetYCQtSUoOLh1iMhV\r\nWHWo5dXl2OU1WEgpeJWVmWlJOZVV9flZVTVVamr6NOV0BbblxYUIxgX+24q4BTube4Wbe5sLezjr\r\ni6vFFVmcCIwoyIWJeHVIiJl1VXV1NTWaXfXEnao62VqbGHxra6sobG7+m9VbbHz4qNWFu2xbuIl\/\r\nmQlqTVqNlLYpqVI5mbRlXLRKlIApW0fuFpEfQ4AAGfIj4w8gPHhk7Ajko8YeGXOM7MHo3kJnAUe5\r\nJHWqlBMnW7CUo3WL4biHyR7y6vUL6C2Ewez1wnftFqZr1Fy2zGYKZikwVM\/ltBrM3aCfmXyWS4Rs\r\nS9gtXfBFo4Q25SZQlF5WixnzSSpoYKDZqspFljBaYfTmnRUmjJhcYbgEPgwmsKwwXsR4cRTmSy5H\r\neW+1+qlXXLq8dVn+TVsqkJtMdIfCOIkxZAuOGS5i2DDDAgWKGUiAcNlRw0wP2USI5BhipMoOIkOQ\r\nCBHye8aTGS1+OAljZUeTJjS0OLnhosUMGlymxACDZEePIESM1MDRo0gNGEBq9HDSA3cN9z9qBAmC\r\npIdMmlWjcUFSAQlV0EADCjDAUAUKJKDQgAgC\/oBCFkNoUIELIowwAgpEVIACDiSM0IIHCj5BgwYf\r\nPCfFCUPQAEIVRNxAAw4\/sDAeDFnIcOB5LqAQgws9wEACCRmE0MMFKITgwoIwbHDgkkGoMsUWrCSU\r\nUGFgDGZYYrCI8ckT7giWCxliFGZlFUKQwQUTs5CBpmKFcdFYYLT+YNlNFX9x9tdlYGRBVSt8ZnLN\r\nNKMw0aUqVNYVxg6zuTCDDSgIkUUKOOzoAgY8xhBbJh6wgMMN5+WARBOzDcEFCjbYcEMOLuAQgxBV\r\nTNJCCykYR8ILIGRkhGyMphBrbKshAQIMLgyLggtZKBECGDswmSMMxdYgU10IiRHiEK4R4cIQWbAQ\r\ng2w7zFBCDjjAMEMWT8ggQw9DIPcDoTnk4EQW4s4w0Qw4CNHELVX8wNpELbiQghM\/sKqCCzLMUIN2\r\nM+QwQxIzxGAvDD8q8UQQVZjnnn3uwfBkKQklxYUUWqKJZitVjMmFmIeRuWZgWzRRGBlOwFIYEmGQ\r\n4aUZnxjzXMn+WzBhxpuJkQxKEEzYbG5fsgSRhZpcKDEFLJhMgQQ2ptB0SCthGFGCqTPE5oSzCfom\r\nggsjPCEECiKg8EMMIgzBRAxNQMgCCR+QYOOOSBCBQgkiPBHGFiWQUIIHM1Rhw2ozzKCBETaAQEIL\r\nVYCgwYLdyiDbFDCMsDYIG6CAxBQcFpsFCkx8U8s1e+L3yenm0vSDl0480YS5TNxOOxPegMHNdLrH\r\nm6Y7WZCnxSFVOOH6Fk8wQUTTTrh4NBJcHJ+FE0ggMXu8VeyNXxFIBPFEDxUbkUXo30yZVfU4NFHF\r\n6UYQKsgTP0CayXNJMKH8Ld1UL8UWxNkehhzcgAhBaQISpOD+jVFkAQZh8BIYBPaEmUwBB6dzAhSe\r\nAITyMWEmwytCEZSgBP1cAQbXI0iU6nIZIbTgAx4AQQwqcDchxAADNMhCB9aGgg98oAk3wEAFRnCD\r\nJ5RABjnoQLc6YKIQIQEFFdDACWIwhS9MjnAswAASStABDFjACSQAAhI+IBsSgAAJGkBBCzCwgR5k\r\nwAUVAAETgVUBEYCgAhX44AY4VIonZC1ritBEXjSxCVH0w06mEYIitoBATbBDkMd7nmRg4Q\/hjWIL\r\npJgFMz5BSUIIwoSoqwLFrjYFMIAwj8+gChNgIK6BOUFURMBBDlrJBSdUoAU5kMEOfnCDH4AqB+0z\r\noxB8s7D+JIChBzOYDQuG8AoJ4YAF23nlvZTjhIUNoVNBaAIY5rYDHOwgm6rMwg8khoIg\/OBHBtqN\r\nE2QyJXEIwQUe6JEIetAEEbAgQ62xHgoU5ajYoEsGLLgejHLQAhTcIAY5AI8QEjcwLYShCilggQga\r\nyqi6jQA+P5TBjmqAAi5MikYvENZ8ivAEA62ABLvhmLBUQFJTgMEmwXiCzeRChpuhKU+BGcyVBhOG\r\nMYxhKylDWRh0Brg9jcEwjJmFGMYkBjN8wQlkEERfPiGGxGQmMTXNhB5zIQulzGIVYLhaOvMyhNiA\r\nQAQxgEFsbPQDF0zkVLOhQauwc4PScWsGP5ABDlxpJG3+GcwG\/IKZFlhQgrZxSwREaEIJcGADJxSr\r\nW8UxGAtuIINugS5YGFWBElggqhqo4Eh0RAFMalGXWOJHCD8gAhJuIAQkmMsIywvCL1tQghswwQi9\r\n2cK6iJBaJDCBtDpgwg\/+c8smCMEKk8DID3hgESEEwQsvymB+4oOEKgThruXpAXqmUFoj9EB8MJjC\r\nfGCwMY5lQRUrbQYiropJMSwkC014Aiwi+AQxOMcYVtBCFdg3PV9oQRRV4B0TwAAPL1ShGN2ARXC4\r\nZKfnnYUtWYDCf845XqiAIRUwuUYVegC1KWABhVsIAw4wgCEMLIhvH+gAHSvQARuwwI0dIAIIPlA2\r\nIsD+WAQlIAJZYRyDFMzgBhzg19qqIMWxCs4DfhOBkaswAg+E1I1VsJAGPIA5D3DhBWwcXQU2IEvZ\r\njKACJKRjhMXBCi64NAnuLV\/rkmCEJhR2JnKRnhSSwMEqSOEJwenG\/I5nJy9tb2azYIKDZ2vA99Hk\r\nerEUgnubYL1QJUF608MP9ojAhCm4QAlIUAIMinCFICgBJuG4RizbG0EiSIEJRju0c54gBSQMoX2r\r\n5oJwicACPc4ZCV7qH9xcGgQpNMERWrAukIkggyH0xgjExk\/UXkDrjBDBCUaoJq25sB4VzMRoTAuC\r\nZlfQXU7vEQxMGAELXsCaHrHgX0\/Y0YJucIMSuEb+UkSIwRNwADlRfUBW6maCDRpVgxLYoARSCJwN\r\nYiADLvAgB9zigQg+4CgNDGEKIjjYwxaEAxQwAAM4cEIQYLACFNSNBTXwZg9UsAIXdMwJG24FK\/hU\r\nmCzEzAxjSPn0FKheX9wsMGYQwxdqJwY0xTxlgglDGbzwGC58YQtlKIMZgobI9o4hMUkN3Cz2V74m\r\nlMIffaIKJvp0PJXuMQxpg9QMKvS1xakWcyTATrwwkAGG0YCvbn3CFwbqynLh4F9ZWJzTqtABEqSS\r\nOU34ABO+\/oIh7OBgUgiCC9y4PmGZIUBhSEEFVLCeFKzAYjAIAZCeV4orAB0MXnhgc7YgBB2XoAT+\r\nKbgBQYQAhBvcVQhbYM677GUExMYrVi7gAQ6ywIMWxEALdgUCr3lQAxmQwAbebgIJ4Mac1rDAR0kY\r\nT7MnsoIqkCsLQHhBwVRgAhfs4AkhCMF6LDYVV2jeC1GaRWKyENOo5oSqMu+wO5T6hchkoTFimPMX\r\npPAFMniBDF9wjBfiX3NfYAZFtwWOEX9KMxiWURXuQAvNQBdgplLQgAorBXReEAZB0DWwRQLLNANa\r\nkAKnwgL5pAWRs4FPQAId8AGkNwMNFWsWwgRNwAEn8DAnYFdGUH8ucAIjQIMdYAQykAVlYQiGAAyE\r\nICXUACih4An\/IBUxUYEABgvCtTdEEEFqsjz+vXNfXFBNUrg9RFAD7jZbVfiCXpAFQvCCtDNnUiCG\r\nQCAE27QDN\/A+cDIJlSEOwaAXRSEOqWMN1cBfUDEFFbh5iDYGTdADBAQLmDQ71sUEPQAn7zEKYQAF\r\nTfAFS9UEXGAFUSMFWSAZNBEGPIB\/QCcYWrBrXsAEUqAFpUhJrHU8KOENiCYI2OMJTqAEUDAFUlcK\r\nWZAEpbBppHAQm9d5LqYcFdAjDfUBMfADKQAEh4dYomYBHNABHZAtKVACLiAEI\/ABGOABRqCDPPA1\r\nNnACHtABkAgJXTAEMlACH8ACJwABQLAaSAYCHpAhDyMbKAACM8AFbsMaOwICm9VxLbABJFD+TCbQ\r\nAxHmh5sXSy5TYFaQF3ZiSdxQGJPUYWHQP5JRX3AyC1\/QBfgnBbNAXBbJGF5wicWwPuw1YdwQL5k0\r\nCDMRVbLACN1BDUrAO\/GCDRGkUp23eQLTPigRTfgiXak3BDNAWlvgBDLiBDYQBNbVBFIABLNVWiEB\r\nBDvAA1rwgkAAiY\/BbMSWZjxwlKgmXC8TbjeAPESgCklgEV7UBEFgEdpVBECwXbgxBTpAAjNZgV\/A\r\nAx0gHSLwA03AAh2AA1XwAqPXAiMgAyfQBDxAAk4gBCdAAi7AATxQBCBgAhRwAidQYifQAScQTYjp\r\nAl3wBVYgAxTgAtw4fDzAOcNhOrvVhj\/+YAQugFm8Mk8doAPowgIp4G0jlQImgAImUAMBwmkDGYm9\r\nyQWaaXNXMhTxh3+BYScWeDM5JwZWkC8W2H+9mX9WEIma2QVd4Bhl8EhloAia2HOFcYC+wHTFEH9e\r\n4AR1UYSqsycEsYtxaQQngCQHo2IcJwQskFY20AI3MHDbQQI60AKJuQORaQM8UAaRyQP\/GZgQY1Et\r\n0ATLCTE8EAUnoAM68G8vGI2OUnqqRwPNEU06RgMvEAJJQAI04AIZ+gL2kQLDYgJMIpCc15uDORzU\r\nxY3IFVitJANAYASp9UtEQAN0FZmytQO6xgNIwAMDxAQ7wAQ8UKTS2QU8IAOcGJkn0AL+J+CgTIAd\r\ngNmhO7qBTgAwLnADKfACRqAC\/zIsuFKiQbACKdADVtOEvSkFYuB2\/bdrzGYbNPd\/WvAEcOMEWiAG\r\n5cEEZ\/B\/a8IEXDIEUsB\/MwV0S8oE\/Vd01qkFo3Y6T9ByiRF\/X2AEUuAEY2AFSRA0S1WK8XcFSbAF\r\nVMAnKxVhoVSBmlkE5ggud3MCUiADIIAB0HgC6iYFRnADIqCXRBAGJEABNxSZbyMFEzCK3JiCkRkD\r\n+JcFHDAskdkaSBoDJMABJdACSAAhJ+CGF2ACN9AB9Jl3OPgvwucjkMMkL5ACKYAgpbCm9\/eCL7M8\r\nTNCo3HA7TTCKX7BfJ5mRISOvyAP+BYNQqaU4apUqr\/PnkaOmLYOpJnOWZtORBJDWBFbAiVJQq8xp\r\nBKp2PE0AZ9NxH1RTBEYDl\/+nrtPEBL5Xf0bgBGcIsVxgBPvqZyWLPbXDA1CQBaTYBEMABUt6fE7w\r\no2j4CCHzgxCrJu4AD9sXSz3ge1\/AXhArAyQbOlIABQ80O4tmBCFQNZomE03YGEfwRCdgA7W3pB8A\r\nIpEZmFKgASxgBNvqQttqAicgAk1gAzsUAx1QAl1AOBRQAhyAASdgBfXAA\/t2AhyQtllgAuSIlSbw\r\nATIgBTFIOJwjA00AjS9GArI5BWKEAndERzWgBAEyXk\/AebxokdHZP49QBPRABqX+2AVhkAmPYV+l\r\naCfV+Zt5qwV5a5FeEAVPoAU88BiSYJFdUF9dgIm\/aZ3VWZ2MAQlSQAWlSA8IBA2j4AVJIItTgA1K\r\nUDsZRhBNKHRQIKE7AAVMoCI8IKUdQQMDpAPEYQTAMQPMg5+MyQMxMJTB1qQhYG8xgKQBupwdMQRR\r\n0BGOIwNHWnHXUQSM+XdIUAM7kGY1kEvzsQJNsALj4gLrUQMr0AP2cQq8+H9xcyrxy6RNaqyS2QHf\r\niwPoMncxcANt26QxIDcxAKUtkGJ\/p7WDupkxCgUdYALw+6TWugMdMAI2MARm0wRuY6MecAKyoQEr\r\noAMs4AQ0AANpgwIrMAMPHDr+pRCJ\/wd0KUN0bEJ0F5moUUAG2Ckm1lkGF2lzAagFkWhzXVB0Buh2\r\nZWBz88deUZAFR9V\/UXBA9Fp\/X\/AIkjEmYkyKX1B1sqC55lcFR0AxiEYKSjCQjhhZM5gD3Mu9K+Qa\r\nOxADLaClrkEDtncqtlQCTzQCe8usOiACUBoDIzAEYhAFHzABTWoDKvCyGeCM8Dt3XdBuPBACgZk4\r\nHdC\/P4AEJEwDPUACIRQDIISPeLObQCcZUuCUBWoDR8oDFqQDOzDJPLnDRSDAt3RcOpC+HSEDRdCk\r\nHQG\/HaGNxNUFgylsAequRzoccMMDRlC7wCdsA1cDUEBs5VMD9CKFSDADRoD+Xd8zHpy2uY+gCZq5\r\nBQ72xJFxVEcl0IERiYLRfwPtxv93VMApxqdKx3r6BaMYxo1aD\/fnBPXXBPtKDxZ5iVCABH7iBAuL\r\nDUIAi7ioi4XMBEaWgx9gAiXAA7n7g7wLvNVJD8C7XzWt0zvNul2QgjwAAjvQAhPgmSUwAjbsAToQ\r\nBdH6AQ8zATrUAjtwNyPw1FD6ATswASdQBCdgAh3gABmgAloABVBAkyxqBbfzPqezQdDZm8CpmdD5\r\n1tNpkb85nbOgmVD8CLfjBA4aBS\/YBauEpNPRBbPFBFGwSu1qBVGwA70FaX2NPEkAx1DwLcxLBWPd\r\neXRcgWLQBb0lBTbQBN\/+fDpNkGaEolvs9YJDIBeGpgOozYlCYARIintCALGsVZ1icM5lwASvyZzn\r\nHAWDHagdQc08MNjLLNo8QAQ24Mr8qQMnELJRUAQ6ANIHFAVMK8z\/Z9NWEKDKqqCe\/DDUPAQfsNpC\r\nMEQwbQQAB1ujhylh5awncFCLiX9d8G8TLUcWQsKQ7MiDLQOx0gJSwKQtIAOvKaGuzAMqQM1cjQRF\r\n4I4m8KVWMNZUgdf0F4mQ2Lnz95x03Jv8Z52di9m5a5FH9X8\/SD4Y7gVo\/AXYWcf9V529rdlvPcaS\r\nYJ02B8XT+Qi9XZ2PUJ2VTdY0GYmnwQM6AIky8AVNGtzcfL\/WjNZZQM3+QsDNOiBD1LzNLMCkwv0I\r\nUP41c9bjMiAEURDVR3rMPry4XrtDkRWhKiADBK57sNyhK5CiHkADDE7WnMd5YpAEL2AD+Zu+uDfk\r\nQjDk5f3IaY17HTECrhEDyKwD8IsE\/w2h0ikFrdLnUlDohb7ZEOuUVmDCOmAFTt4Eha57J6ACINfn\r\nMyChOhACICADPuDmm\/vEm2lzJV4GPzh\/Y4zhbiqdnTtqX0A7LC4FViAFmrmR+Ze7dN3Fuo6JFymd\r\ndF2dcDqVmtkEhi0Jnfh\/IF0EmhkFxJWyUwAFG\/5\/TvABkfmXTtlOugdwXmBYclkC3OLfBCqa\/PQB\r\nT8ADH2BwdXvJIzD+RLxuwg6lA0ZAATNgWN3oAlAQ6NzoqpX5IVEgAll9jl4bAsztBBigbiOgA0XQ\r\nASDQBY\/oh9M5W44KBWI9sf+a60bwzddTqcS2QV1AZ7fT27Uj2kjAWuL7BNVpPUgaBVoAHCSv16A4\r\nikyQt7W6rxf52bqmaxEUBbJrqZAdBUZwBFQQBTnusfX33p37oE5ABFHA4cvpBS3PA7oOiTe\/Sps5\r\nBJBY3kBenVaQt7pLPsCb6RCb66UIBUBwkRk5BNFuBJPcqCaAlQ46O1GAaIUNBYFNBYm9BHGp7Mu9\r\nA8S3QRPwAuAO013gUJElBfPEn3vLmdQIWxjwAe0ZAxIAWCIQrZD+mAXSii40OAIcEKCXfAJAIALp\r\n2wE84AIdkAE1fAI\/kAQe0AIgQAF2wwE6sO2RqQOPmQFD4Oa8eZGSIPYxP\/Yx6wVjH\/ZGe+x1XJ2X\r\nCLxW4Ha6S+M0Xp2YKPY07QQX2dH0euwW\/brfP\/FPIPbDT\/1dEAXnDwXoP5B5zd+2e6TbHOT+PQTn\r\nXKlIugMpQAQ8ABzAwd8qpv9kAAgtPIOERl9Wgzo8OiWIg0ZAkUAtNEA8Rl08Jz6ROCxQUYMtO01E\r\nijEyOoovUVBQX16xXmJSPEwnPIhFMjY6TTIfIiXDNk0sPDIjMiwjxzJPp4NNLSMfLCclOkZeXSfM\r\nMSMtRCOmPDv+LTIyJ+gnNFInJ0U4KS0lTOYfuExIMagtOsmERJECRVasLl8SilH4RcysLl6+IEzY\r\npaKViBUtWskopkuUjBJBZoQYKyREKyYrpuTmRUusjV02ckN4kKXHVrHAyIKVMKLPkiVhTUQ40WBP\r\nLipDcjmIlBvSpV2QjtwysgvVii21VM1SNeZNKx\/BuvppMGjEhLAOogUqUZZKiFjdwh05c27Gq1ap\r\nXqWq9UrLrjC9btwYxYqWVj0N6tyZuCxNlhhJpvwCdalNrBWlTu26RetILX25ec4YVrDFwwVzluXJ\r\n86zr13XTEk0bsqyXynSl6kXqmS\/ojFqujPYaE6aVwcdbFQT+o3OxLOetacPOCDSy05qQndqtuEXv\r\n8NG\/vVz5bHHkx49elXtxblvx2p0Gq2KcyaXt7aX4pT7lojmqVi2djeQXFr514ZlnxhkXFlhNMMee\r\nbWnB5lhddZGElH1QbVdVfxUd2KGBXYz3G3HHaURiclA4p2J71ZFkVFzxYVSbLE3FUmNUH4JoEW\/A\r\neTaeaR5lhBxhrjDX3oMsSiiXUBJtoR1mJEVVoYEIAmdlceUZh+VxXHYZRRRHLvagi9lB5uJs9k3Y\r\n3V2ZWZWXkDp21QVX5dHJZXElghWFE0muFx+MgNL1FlFeUHUQRFsgRZVU3OA1IleGGbiRnVoOZuKQ\r\nxe1pG3QgzkUpH1yHzkTfdrHoxV1neq0Zp6UnnmZaieVlqmcTgQAAOw==\r\n",
        "names": [
          {
            "namestring": "Apomys microdon",
            "identifiers": {
              "namebankID": 2480869
            },
            "pages": [
              34572132
            ]
          },
          {
            "namestring": "Apomys datae",
            "identifiers": {
              "namebankID": 2480865
            },
            "pages": [
              34572132,
              34572143
            ]
          },
          {
            "namestring": "Apomys sacobianus",
            "identifiers": {
              "namebankID": 2480871
            },
            "pages": [
              34572132,
              34572133,
              34572143
            ]
          },
          {
            "namestring": "Apomys musculus",
            "identifiers": {
              "namebankID": 2480870
            },
            "pages": [
              34572132,
              34572141
            ]
          },
          {
            "namestring": "Mammalia",
            "identifiers": {
              "namebankID": 2478620
            },
            "pages": [
              34572132,
              34572145
            ]
          },
          {
            "namestring": "Apomys hylocoetes",
            "identifiers": {
              "namebankID": 2480866
            },
            "pages": [
              34572132
            ]
          },
          {
            "namestring": "Apomys insignis",
            "identifiers": {
              "namebankID": 2480867
            },
            "pages": [
              34572132,
              34572134,
              34572138,
              34572143,
              34572144
            ]
          },
          {
            "namestring": "Apomys littoralis",
            "identifiers": {
              "namebankID": 2480868
            },
            "pages": [
              34572132
            ]
          },
          {
            "namestring": "Apomys",
            "identifiers": {
              "namebankID": 2480863
            },
            "pages": [
              34572132,
              34572133,
              34572134,
              34572135,
              34572136,
              34572137,
              34572138,
              34572139,
              34572140,
              34572141,
              34572142,
              34572143,
              34572144,
              34572145,
              34572146
            ]
          },
          {
            "namestring": "Apomys abrae",
            "identifiers": {
              "namebankID": 2480864
            },
            "pages": [
              34572132,
              34572134,
              34572143,
              34572146
            ]
          },
          {
            "namestring": "Muridae",
            "identifiers": {
              "namebankID": 2480343
            },
            "pages": [
              34572132,
              34572145
            ]
          },
          {
            "namestring": "Rodentia",
            "identifiers": {
              "namebankID": 2476907
            },
            "pages": [
              34572132
            ]
          },
          {
            "namestring": "Apomys gracilirostris",
            "identifiers": {
              "namebankID": 6253589
            },
            "pages": [
              34572132,
              34572135,
              34572137,
              34572140,
              34572141,
              34572142,
              34572143,
              34572146
            ]
          },
          {
            "namestring": "Crocidura",
            "identifiers": {
              "namebankID": 2479448
            },
            "pages": [
              34572132
            ]
          },
          {
            "namestring": "Rattus",
            "identifiers": {
              "namebankID": 2481308
            },
            "pages": [
              34572133,
              34572138
            ]
          },
          {
            "namestring": "Abra datae",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              34572134,
              34572146
            ]
          },
          {
            "namestring": "Abra sacobianus",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              34572134
            ]
          },
          {
            "namestring": "Abra insignis tardus",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              34572134
            ]
          },
          {
            "namestring": "Apomys insignis tardus",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              34572137
            ]
          },
          {
            "namestring": "Leptospermum flavescens",
            "identifiers": {
              "namebankID": 2667793
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Pinanga",
            "identifiers": {
              "namebankID": 2676085
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Tristaniopsis",
            "identifiers": {
              "namebankID": 1835729
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Psychotria",
            "identifiers": {
              "namebankID": 2657027
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Actinidiaceae",
            "identifiers": {
              "namebankID": 450127
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Melastomataceae",
            "identifiers": {
              "namebankID": 455402
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Agathis gracilirostris",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Arecaceae",
            "identifiers": {
              "namebankID": 471130
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Elaeocarpus",
            "identifiers": {
              "namebankID": 2647542
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Syzygium",
            "identifiers": {
              "namebankID": 2651219
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Cyathea",
            "identifiers": {
              "namebankID": 2576521
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Fagaceae",
            "identifiers": {
              "namebankID": 448315
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Lithocarpus",
            "identifiers": {
              "namebankID": 2646003
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Astronia",
            "identifiers": {
              "namebankID": 1832944
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Adinandra",
            "identifiers": {
              "namebankID": 1782405
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Theaceae",
            "identifiers": {
              "namebankID": 450105
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Praravinia",
            "identifiers": {
              "namebankID": 1786070
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Myrtaceae",
            "identifiers": {
              "namebankID": 454931
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Decaspermum paniculatum",
            "identifiers": {
              "namebankID": 9385154
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Agathis philippi",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Symplocaceae",
            "identifiers": {
              "namebankID": 452225
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Moraceae",
            "identifiers": {
              "namebankID": 448146
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Saurauia",
            "identifiers": {
              "namebankID": 1777876
            },
            "pages": [
              34572142
            ]
          },
          {
            "namestring": "Apomys gra",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              34572143
            ]
          },
          {
            "namestring": "Chrotomys",
            "identifiers": {
              "namebankID": 2480922
            },
            "pages": [
              34572144,
              34572145
            ]
          },
          {
            "namestring": "Apomys gracili rostris",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              34572144
            ]
          },
          {
            "namestring": "Chrotomys mindorensis",
            "identifiers": {
              "namebankID": 2480924
            },
            "pages": [
              34572144
            ]
          },
          {
            "namestring": "Murinae",
            "identifiers": {
              "namebankID": 2480810
            },
            "pages": [
              34572144,
              34572145
            ]
          },
          {
            "namestring": "Tarsomys apoensis",
            "identifiers": {
              "namebankID": 2481403
            },
            "pages": [
              34572144
            ]
          },
          {
            "namestring": "Crunomys",
            "identifiers": {
              "namebankID": 2480946
            },
            "pages": [
              34572144
            ]
          },
          {
            "namestring": "Anonymomys",
            "identifiers": {
              "namebankID": 2480840
            },
            "pages": [
              34572144
            ]
          },
          {
            "namestring": "Rhogeessa minutilla",
            "identifiers": {
              "namebankID": 2477904
            },
            "pages": [
              34572145
            ]
          },
          {
            "namestring": "Chiroptera",
            "identifiers": {
              "namebankID": 2476934
            },
            "pages": [
              34572145
            ]
          },
          {
            "namestring": "Brotherus",
            "identifiers": {
              "namebankID": 4095773
            },
            "pages": [
              34572145
            ]
          },
          {
            "namestring": "Orchidaceae",
            "identifiers": {
              "namebankID": 467852
            },
            "pages": [
              34572145
            ]
          },
          {
            "namestring": "Tarsomys",
            "identifiers": {
              "namebankID": 2481402
            },
            "pages": [
              34572145
            ]
          },
          {
            "namestring": "Rhogeessa tumida",
            "identifiers": {
              "namebankID": 2477907
            },
            "pages": [
              34572145
            ]
          },
          {
            "namestring": "Limnomys",
            "identifiers": {
              "namebankID": 2481054
            },
            "pages": [
              34572145
            ]
          },
          {
            "namestring": "Chiropodomys",
            "identifiers": {
              "namebankID": 2480911
            },
            "pages": [
              34572145
            ]
          },
          {
            "namestring": "Abra abrae",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              34572146
            ]
          }
        ]
      }
    },
    "2002": {
      "biostor\/81423": {
        "_id": "biostor\/81423",
        "_rev": "1-40fae43651e9b31d2acb0501d43db2ca",
        "author": [
          {
            "firstname": "E A",
            "lastname": "Rickart",
            "name": "E A Rickart"
          },
          {
            "firstname": "L R",
            "lastname": "Heaney",
            "name": "L R Heaney"
          }
        ],
        "type": "article",
        "title": "Further Studies On The Chromosomes Of Philippine Rodents (Muridae : Murinae)",
        "journal": {
          "name": "Proceedings of The Biological Society of Washington",
          "volume": "115",
          "pages": "473--487",
          "identifier": [
            {
              "type": "issn",
              "id": "0006-324X"
            }
          ]
        },
        "year": "2002",
        "link": [
          {
            "anchor": "LINK",
            "url": "http:\/\/biostor.org\/reference\/81423"
          },
          {
            "anchor": "LINK",
            "url": "http:\/\/www.biodiversitylibrary.org\/page\/35518840"
          }
        ],
        "identifier": [
          {
            "type": "biostor",
            "id": 81423
          },
          {
            "type": "bhl",
            "id": 35518840
          }
        ],
        "provenance": {
          "biostor": {
            "time": "2013-03-11T17:25:14+0000",
            "url": "http:\/\/biostor.org\/reference\/81423.json"
          }
        },
        "citation": "E A Rickart, L R Heaney (2002) Further Studies On The Chromosomes Of Philippine Rodents (Muridae : Murinae). Proceedings of The Biological Society of Washington, 115: 473--487",
        "thumbnail": "data:image\/gif;base64,R0lGODlhZACdAPYAAENCPV1dVmJjWmhnYGtrY29vaXFvZnV0a3h3bnl5bn19c4B\/dX+AdX+AeIGB\r\ndoSEeomHfIeIfYqKfo2NgpGPg4+QhY6QiJKShpiWh5WVipiXi5eYi5qajZ2dkaGdjqCfkp2gj5+g\r\nk6Kjlamnl6aolqiol6WmmainmqeomqurnLCvnq6wn7Kwn66uobCvoa+worOzpLm3pre4pry7pra2\r\nqbi3qLe4qby8q76+sMC+psC\/rMG\/sL\/Ap7\/Arr\/AscDAp8LBrcnGrsfIr8nIr8TEssnHtMfItMvL\r\ntcfHuMjHuMfJuc3NutHOttHPu8\/Qt8\/Qu9HQt9PSvdnTvtbYv9jYv8\/QwNXVwdrWwtfYw9vZxN7d\r\nyeDaxuHeyt\/gzODgxuLhzO3o1AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\r\nAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5\r\nBAAAAAAALAAAAABkAJ0AAAf+gD9HQ0xMUFBMUlBUUIqGjYeQjVKUk42JlJmKlFGZVJVUn6GaV1RX\r\nV1JXW1uqlFuurqynUq+vtLKrt1s\/QUxDh1KPk5qVw8PEyIvIUp\/Mos6nz1tUtq6otrWqrLqr2azd\r\nUkG9wsCRwYaakJmLwMGVy56Uz86moVlUWbOm36e53f3aanHbdusHIWHv4DViVAwevFBRqESMElEe\r\nviinUGmMlXEbuFTfXrXypyrgrl+\/1JlL1AlYM0npiIkaFaqZxChW6pm6gjGjz1P5fGIDWNJkSIFb\r\nghyURLEZp3WbiB0L9qlTqZoZ7eWblq9r0CtZaIFVFbSb2VVZtp5d280gonb+FKXElctO3lSnVZtQ\r\njHIEnRS9R1oGLtKEid4oeq3gbCJX4pUmTR5DThL5L2QrV6xYgZyKcT+zUgweOeQkUhQopw+d\/mTu\r\nELlGGFNI6ODCxAkJHkZIEKFBRAodJlI08dChw5EWDzhwCN7hBIcgNVJcGaHiQ4wFMKjvUOGhyYcP\r\nO1x40JAi94jv3f0lJRTJSenUqFFTtCIftSL5eykWKQIESBEjQCBxhA5H7HdEE0pgtoQRTWQRBRJG\r\n4LTEEk0soVkVmVWBYYOZTdbEFlUkQVkTVuzQRBKbEWGUaKrlN0UnTckFY2OdQMQTRj1Z8ZVPX\/UY\r\nVFo+\/rTFVqfAoIMLO+z+QMQNMezAxQdIbuHCdzWAJRCLTuQnY1Nc3hSXlxVZIZdiPIlJUWaZ9dQT\r\nUD+hiRmPP3KRhA7nUZAABRpQcJ4OVmzBRRFJWJmLFECwl2V+EZVyGqIT5XcjTojtBaZmJCq216M4\r\nafZmRptqdoUWO6SAwQIQUJABcRPg+QEGejr5RVdmGVQaFEe4R9oTRvgApGJALoFTFlhYcQRmiIGV\r\nRRWapaXZElhgcQUWaT0LrRZZUJuZFlYQYUUVS1yxBLJadGGFBh8gYYUHH2RQQxU7tKBCCjt8QO54\r\nfEbb1hGjQeHeExQ9kYUAGaxAXAIKpECCCEvUcIEINDywQAot3IBEC77+ReGAAi3AcMQNCnSQAsQc\r\niADDCSk414EIJtRgBQwJmMBxAB9YgEAHH3AQwAImtFDFBxTUhnELFFigwQ41eIDBdx\/ocJZBjzwh\r\nnxNPaMGADREcoMEBDSAwAQdZdKBA1gdEkMAEKdzggNZWPPDAzERccEEBGmRwttYXOOBAAQoQQAEF\r\nRnRQQBFTTqAABAoUgAAABSyQ+M4jTDDBARZYMLYFXGRhBZ0pbJGDCroUOpp7\/T7B715pSWS5g8Fq\r\nqrqOwDZbLbCWU\/s6tVrU\/sWrX9Tup6eW67hDcV+wbuyQr3+FWRYnbvFFESO0JUStTxwqOr\/T8yuR\r\nl5BNaMWET2zmfRH+IlDQQcQtfNBCBzdEfIULD0DwQQ21ZexCDTUgccqbVXDRAbKespvZFvjj1Las\r\noIUr6IALMcjBKoTwvFpJbwndq8L0zpSpGz3BQlHQHmZ0NKUFPCBvFxuAAwgQABM0oQYLOAABCODB\r\nAChgAApwwQ0s55MqLKBPrAAVBGCQAhecAlkZKaCzstAF8GzBA6sQhHuWCLXqTRBRkBGdr7Y3octA\r\nhghRUEISiDAhESWBQpehzBeXICIKUSgzq6PA6nYwAXl94As1oIEVcLCDK+xgQuBaAgW2oIId7OJ5\r\nTHSiFaZnqb1oCoOI0VSl7vcmTY3lfm2K1qYykw8rcMEDNQheta7+wK4kwfEEWnCBFWjQgeXYACxa\r\noMAOcqBALEEtCtWDpegyBSnFaIqWFSTRjTQDqUQ+8kL90xGbPKWjJExgR7VL5v2qgK0Q7eAGp+AC\r\nDKQwAj8qpS9OOIIUlTDLCV5QLyTKnoWQoK1MkcgIN9BMoByphROpyFhASksSYrCtHTDTSlfgggsm\r\nMCT+YUZDwNQMFrQALVUAbgt7PElpmhhLWBpSdbTEzA1SEIIQTCgDVijCBGCAgw4QgQYmTEEHTECE\r\nDxABBzCoQcZaAL8dEIAIVTgfkmjwvvzpIANIeJWO\/FS73iWzd\/nYARhyA4b1OHB6U5jC6ChSBYoc\r\nxpDzWcIN0sf+RRhw8QY2sAEN4hgDJZggOCd0AQxuUAMbwK8GNzgCkthFv\/CcQAcW4sIOxKehGrQL\r\nCThAAkDxqlcMcQGhCT1JvvblTepBEZYTgpQ\/MeIpNGYmWNYyFj7jqSMNVeuvWeDChZgpzVR9IAUQ\r\nMEEHEGCBDmiAXDDgQgFrMAEkruIKPyjCYGXZzScAlJe23JYGNVVJb0GGkZtRArKMl4RgWRaNlT0u\r\nMPmXBRjIywIngIELWFq+I+HgAx44gVBfuwt8uWcJUOOeUp8AAxDc4AQmsAERWoACG4Sgox14AQ18\r\nAAMY7CAJLShCBjLgghTAoAUn4FgLWiDDGjThBuZrgQ2qoNX+Dyy4BeFJkgZUloEWWEClO+BADZJw\r\n2gMsQASRM8EHxreu4JWEFUrUF3gvyL2m2uAFQCDrDfbzURigU6s0uMELYkCEJKSzCDKAgQxoIAMc\r\nVIEIS1KSkrKFAxvgdQc4eEFeF1yF+rbAyDuQLltZmgQNEc2elByoaq\/F3R8IYaG+QqyvRAdEsDC2\r\nd0+AlnGdRcnjIQ8JCzoyDm5AhCaoaAdd0CuelQVEO3OBkp9KFhcq943KEnBbVYjniXch29H4ygkT\r\ngqDooGapW2I6sSu2LTAvQ7EOTGAHJhDf\/FDUAisM2AYusNBmkYUhDGVodRrKta6tkLpIB+szV1DK\r\nQkeXaQn+ReE9GaQiFiLYLCzwjycFKiD+yHiEx2wmMjTc4CmaEOm\/ruKfQ8Ks5SKthVX8VUesGyC6\r\nsxCrIRwBvEu8YPWW4DEJoOACWN0ADHwg3xf4e6JqbYEMNBCD89X3BljYAEtRloQMdMDKLSBpCzSA\r\nBLF+4ART2kHcaJqyG1TBBS7QwPxOoF0tRDpZXhFmP5jGhGxGr4mvXIIMkPACct5gCUior5BxfAMa\r\nKMEGRtgYWm\/Aww0n4ZlYzQIRhIzVlBZBBzeo0H8j5oIi3GB+NICBVksUHhrgQAMnMPKnNDR2Tn6K\r\nu55refSYmileQYtYkpX023\/EbiXcgDLby8KcfDDVIvz+qQhK0FYRsGUUVNauckDJbDJr5xNsFbDc\r\nGOIHlhyYpdHN0qGXwonTkr29zZgzCym4gGhBnvWTieDhSagBDGhwgiXQIApVkIIi\/bk61emakxrC\r\nVmNPUW5ZYGnT\/WIUohQDwb1MkURO7TRkwomm+0VGdch1ZO2n38jaFdrkbdIGi\/TFL0xX\/oIP7TQE\r\nefmt7t1yPmmCKE6AC0ng7r759ztdWkB0LJObnJnMNLksTiEaQ0CPxbSlaYjlPbBHPZnmecunGAkI\r\ne5ayS94zatIXUBK4LWYHaWPXTNZXBWcBBL1wCIFBW4qhBErQLGCBW0\/gA0oQBccyglUgICroKZny\r\na5n+UW0bxGvIlRHDwi7qVmeNpRnYAiS5d0\/K9CavlQNDkBL\/B15RYAQZIAIvkDFjBQOyZgETgAIV\r\nJQIKF10n4Bs8ZBvOFTE3AAH9NWBFcAIRN10Rl2UbgAQmMAEPdwLjUz5yJFos9R10lDPj0wER0ALw\r\n1w99cgU84G7uoU1ZND1GIF88QAM9AAM9cHPbQgM04G\/yhQIwkARAllI1gGTpw2dEsDFLgGSEMVFb\r\nhGQ9dgQJMiFGNl31kyScdF8t2FciggRJgARgdjzgggui8V1NtCC5coBLcARGEGqiM0jT4wRGICyV\r\n9IGBUW3DonRHoC2REXVZ8Iy2lgTDAhQDFCgA5S3+dkR2qhAo9hcthEdAqmCEDgQ9wAgCKZABG\/AC\r\nICBaTagBJqAEFBUCKJABJtADFhACond6RSBSHlUcbhg0HzABR3JxRLABG5Vh54MEPKOQrUYBC2AB\r\nLkADFmACGZAEJ6ABG7CRJnBaFgBg+zOOOoItKBYE++JAS8BNR7Bg8hYsWBAFNwAFnWcEotOLnecr\r\nzNcEOvBOIVIpJGJc3YIhkEYpFkIilHEsxEQhAKVrvdODBfQNkxc6MgA1PoCCRcADRMADdgeMPmAE\r\nEqQER4AFn+gCL5CJQKBeLXAgT0YEO6ADRqAFMMAwEDZHJ4UDWIAETYIDA0ZWOKAFLLUDW8VJAwb+\r\nKklymDvgeI9WbivnbpT3BC9yATa2ASFwMBeQARfAARYlAyiwASdoj06wjh\/AGyhzmRR3A6ZCMiYg\r\nXVfwXx2wAR2wBF9FMVjgAh1AUwM2XTRQBTTQAqRkAmxlZHIIUpBIe57yWjwgBG8BNarRfRA0Bfjg\r\nBIpxE1PQLAJlW\/ySFipIQ9UCRPkALgNFUMDSUyZHRPlweK\/CTD7YBdVCO9vCaIlWksnyD65UeU5w\r\nAyjQASgAAk5ABCEAA0UQARxgBJwZAisQAlUQAiCwAaQkAqeHPlFwPiLwAQpHA2q1mhFXXxOTdXxp\r\nAqPEl6TUAvsFUjjQoUiCYeejMhaGBJYDQAD+FC2qICseuC9O0ANP0ANXeYI2agRaBYxZRQMLhoIy\r\nsAQv4KB8dwO48gIr8AI3wG9GcIgqMD8pgAOj5HU2oGAMRgN4BQMitnom8C1c2mRIAIkrxZstYC4C\r\nFSzs9lqiMRr5ogRQUwVdwGa25QNY0AXB0gNV4GxY4ANziqdN0AM9QATAoiOp02zgolrVggQjyKfN\r\nAlDHkn8tSFB76mzckiEZwqeQejodgSUpuETuWAEKGgIygAUgAAIWcAQrMAEgEAL8to\/7uQQp4Dhu\r\neAGmdgIoMKBtWAEOyqA2wAEScAEbsAHK0QEZEGWnBgPEWgUmoHCl1QF0pAFjtQEhWT7jk2v+6BZp\r\nnepuUPAE2rRpV\/mVPMADPqCjPHCjNuAD53qVNuoDVmB3N+AfEMJnStCuNnADOKAELJUtRrBePoBn\r\n8+Vl34IE5qJXvQlpLWgFeJVrUKaetPcVWxCIj\/kEcCqoKLCjRtCIRyADN9ADL4CjVcADK4CfL8Cx\r\n3oJONWAhUtWIS2ADI5g+UmUhVVCiLbgueWVPeqUkZGQu+Ios50UD9kRH9rSpcxcSuRhvuKKgE5AB\r\n6EQClBkCGQACnQkCL4AFMFABJlABFnABFsUczSGrFpCfLRACrdaGHpMCS+ACsFll5zM+H9AEXPoB\r\nI3M+cAglVaABE3BlvTlgH7CaROlI2gD+iIDkBHBaPTEparxGEdYpb08gLnHmOg7iFVmgBMwSO2pa\r\nOZw6d+KCBANlnbrXBRnyg9TCBc7yLbKje0MkTN+QnEyUJca4AUsKAyK7AikAIDLwsfwmA0eweimg\r\npPd6c7\/6ATJgA663bziQY0pgBL1pVVbVcw4JA0hwmzcgjzDALjggQ2bFZ7WBAzWAA1wQOXprA4WK\r\nRuzWDxKrL1CTvhVFAiSwAiSwoD2QAhyAAiJwoCmgqnPJARCDMj5AAsYqvWQDMRNgAkWgrBtgAqQ0\r\nVSYwMRbloMURcbwJUiijYDggYjawelmger55ZQGlgR1hhENAo90EnV1QncASEZYCLdP+WJ0UAVTv\r\nBhbSUy3Jkni9owQEZSwElAXdYm0nJ2dmd1kKe2izI5\/0V2YhjL6VFwUbUAHDegSy4aAOLIXASqyh\r\nuQG2OgEvMAEsIAMtkJmvaQGwOawXALcbhQQT8ABb2AIcMFIbpQEXMDFxuF\/O4QKR00YVIjQfgAVy\r\n+LcggguA6JiB9HM8oGNGYAIyAARGIAT+UQQyybE38CBTNVWBpwQEawR4hU4o+JVYpARG5rzQq684\r\nsAT\/urDssrB4piFIYAMLjCKlHKloulk\/kZyDRT1wOgXcNEtU8B\/4MiE6DEG58q44QQT2k0iPTAQJ\r\nEgVGxkVo1C3vOkB7WsiFymu9hiz+2kMtTmlPFPhIkScWMyBs8QY1KWDFJNADolVR+1UDAkoDIlVR\r\nwREBDyACMeAAITABCzABtnoBDeCq1EqZcOhwO5ABA6yQHJBjBRAC6XMyefsCpeWGohVTjjNgp2Wb\r\nGvBsttYKghvCLvfNU2CT2VQrE+ItUCCW30q5T8CoTrUEIZ1pssZpGdIERxAi2tNXwiKzVVAhCnuU\r\nwdJll7pc6hZAHTEDZ6Yv2tStTyADKzCuMLACS5iWMRADNyADRh0CRkCPFywDcFs2E2UFWKUDF9xe\r\nWpcx4ZG2Z3oEIrBnFyxcJyC3OAZ18JMCKlUFN5Bl84MkDRs77ScLsuweIhg9RgD+ArRrhSFABD4g\r\nAhewte0YAs36AkdArChgAvSlcCLaN\/E1tsYaAg5qAijQAkpASlepcIgtApx8Ppn9AjnzhBV1rQpW\r\noQgcAi9wWwNEZ\/kA1NnERLWMp1bwItmkBCEdkzAZZ\/yiGGoKk3JGLVHTBRZSO9BiIcLdBdjSuQTU\r\nU+HpbMwdLs3WudZnfZoCk4\/EuoQlOlOwoCFgxTJQ1LwRAizwBOrVmSgTAj2w2S+AAvzWc7dpAoUc\r\nAg9HiR2ABDKwwEQ3PpDdAf\/JYCKWY7eJA5K5egMGtGA3pk8oAi3Ap5gB287C3a17n0q6Ake9kjq2\r\nArqLAkfwAimAwC+gBD6wpJr+Hckuo6U+YI+rlz4\/16RZlTMm8IQt8IQMdps5FjHrdWVR5ps4ADFK\r\n8IRfVb28JlBskgWBiNGb5q09gKfNAktFDpOoA5NaUK4UCywJ4rnNRlDNJs3V3bnNJn\/R0hVaUDly\r\nSi0DBTvtWaicKhSyzX1OoFROEAEHcwMkoJmAbQS5CgQlCwOvGQKlpQQK6Yav2QH7KFwSBOVtN0hF\r\nqRnm1+g9zT+01tPUJ1AwambKicTHBtVP\/aRQ\/QJGAAVW94zJO64dIAOUO8gyUAQ9wAOCCnicV0uK\r\noSHUc0uaYpzqdlvGKemUPuZXMANHHD38ghpJlVRRkFTN8iJPPgVGHs2Qq8L+Rb46lZLdla5tnuIs\r\nRa7maHKoXU6Cx5MRyZkSSPtKe8FQw4d51FProSNLtvTo0w5Qx74t5nTrtUd7kp46uOUg384KrIvE\r\nTgSZhfRQmmd+htRU87HotveA007v1U7pDQ99ybIPvy4Ev3Aoe\/EiURCTittLGX\/sHW\/rUQ6TD49c\r\n1gny0bd70c7tNSjNRf4TZjYrE7Qve+FN+aEY3TQfOgakkAgDkviEPJ919KNzOpdjUwWJWZdOsEdr\r\nk97ovJ4pyNJ2+VAQQQ0FU7AvSvUig0QRGG9Ijz5I\/NNLjC5qA08mCB\/2jB7tD5\/2jnViZpYStVX1\r\nDkVIB4\/13QMphJRbXX\/+W22HLCQSQepW9mk\/ffxDZz4hK3rNULUlQTa\/VLLUVNhJPRLk9+a3WJry\r\n24pP6\/ReKcaJ77p+Ifge4ZMEW8Ee50LAA11QgGuGK+6a9UTQA8TYPaKcBV\/Z7raFBTcQjDawA4Hh\r\n6AqLZP41SClIzUW+pziAIqlcot+iGVLILatvIcl7GB1xEo8ANQqdAj7AxJTZrCN1AzzQAME6AQdc\r\nUVAbAq5WWvRGhQfMAbY6UiiAI695ATjwnyEQ4ifzwBZFBOi\/BBbmNm5IUQrZNoBA0dEhYjLY8XEB\r\nw3Ul1fgzdAQV9fTkdOTkJHRk5fS05OSzVOm5ZGU1+lmFtWRU5bQU5aT+NLqkBKtkFYX6pLT69GvV\r\nVGVbVWVFa3pKvNSEqqzkLGyMWhUFlXW1pQ0paUSSIsSzIlP0ZHIDg0JepJTSk3KTgrKE0mMkA2Pk\r\nJPKiJHIDSwoLKFqIOAFkV5Qb9JS0eEHExo0bSpAQMfICRwoYO2BYaeGCCBEYOGogadEiSpIJIZDY\r\nwKGxyJEMTbJsu3Llx6YoQmCwkEFjBcAjL3yEWPEihRIhJl6ggCEihBIbEl9wsIGkgw8fSau0kJEC\r\n5YQbu5rQCGFESQcTD2ncIFLEB4wWc1vQoIFkQ8YbdFPQeCFiSZEMNHDcePEwCRINSrLhzDlkCBQq\r\nVLBgmdLFypQsWJ7+dHGCpcuUJ1miZMnS5YvlLp2xZFGi+jTr01q0RPFn5QoUJU+waFlSGwsyJUqM\r\nNNGxQ4vwzLAZcal5xQoRJUWsaLGCI0rt3F+uOOY2xAnPFCFSgIDxZJ2NECgqVIBxZEOFwCtIbOjx\r\ngsRWEVFfJH1hAg1G9NABDkpAlYsVA71QGAocWGHVBPxxMYECdLVgQwsRcbDEDRZEYYQhH0xgwhJJ\r\nPJCBC0d0gAIR0G2xhRTdQCFECivYKMMTSPUgAwo4PsEDRE4ctYINdxnxxF9U3aDXDSagl4IoMhBh\r\nShQjwQDDDRlW4QNxRRixBA5z0VAXDj60sEQNLSBjoBI46NCYEhP+GQGDDUAskU2MW8wIRSaeXHKZ\r\nD55gEUUUR1hmhBGvWYFFDz3wIIoVr3VoRZdP7MKKlrucwqikYJ4ShTJEIJFFbqV2usQRSOgSnTPC\r\nWYFEEyDCGt1jUsTIwyZT8AACCRJsEEIFPfiwwQUobMDABiLIYEQHMvRQwQ1WhHDBBRtsAEMUHJiw\r\nwRMVPGACeWmhYEIRVxzRwlodKCGBAhwoccEEHVwroQkmZCBCCztcYAMMCwhCBAcdVNtBCxpokMEJ\r\nMuCbgQ2MNCJFrpn0sEIvSHpSCSVHJNrDE6NZ0QsnmYBMSxRVANMLcaggAcwSx1iRRBFIGAHrdFgQ\r\ngRIRO+yAhEX+BuqiRKEixbrEEjAgsUPMxQlTNBJ43oqrEH4awQMPTwz4xBH1wcAskj4M64Q8vRDR\r\ng0hHXL1EC+9kjQUOSFh5gzJWHDH0W1nasIQMcUfRRBE7iIJE3BHp4MIxJ+1QhOA7VHHEEkSoUIQz\r\ned6qUyZCVFDtCyFsQA4JIqyTAg83SLD5EgASe0EHHKDg41YhtIBCRjAI0kMIFqSQWxMndJBCCiLM\r\nSy0MHYRggg1scfA6DSjsEHsKG6SQ1QXbpvCBBXQ9Ka9fR2Rx6yPheWIEZlFYNoVwWWyGxcZTUGIZ\r\nZ6cI9+oUVnTB2S69ndpFdKecRlsWWvivi2xkwzXKCU5tUHP+nSpc4YDH8M11msCF\/TUCRjKKBI1A\r\nAIIS2EgIFBMCDS6QAiKkgAEk6JENZOCfF8BACFaogZzOsgIU0KAHS7hdlJTwASXgJGA4oMFLfIgV\r\nLHwAJjG4gQg2YhgcVGEkN6iBDUSAhLms6gT4wgERbuCCJhBBA97RBuUiwZMQgGADGPxaCKrGgQ0I\r\nQQbrcZ4FhLK5F1QMBUYhAXs2EC4jhGBgPaBBB5YgnCWsJQMFI8STsuA7cvkuBBwwSAu80gEaROWP\r\nO+iADbBgvLXU4AMdqEIlk+AYKUQsCFDokw+mgMryEYpTpTmUJ3Thmli25lKXOk2h4Peq0nBKGf5T\r\nDmeU0Jn+iiyQf5aJTv+u475j0KY2WriCb0yljS3wIDxR+EEEUmAfexDPBBLggAhIcIESAIEDKagA\r\nnfbYAhP4SGATyIchrmUBQsRTBBtoTBM0ABB6hgUJPUTBBcpTIpxwahmcOob+CJqbU9QqN13cU2RK\r\n6QQi\/IAImNiED6ZjBCQUISG0QIITEnWDryVDCaLA6EUoYgQcZDQX0SECTNIxEVv0bFSB48QwhCGN\r\nl1VBVsN42UA3tb+bVNAJffLEFD66CyBAIQWFmkQr2tEZJ4CKUCBSyC5MkYrenCJRxjRmNjiFk1fh\r\nRBoJPehBB2rWUp3mMTiR5hCEQAUecE4+1hPCBlAgIf7+hGACKViYDXxQgWttwALW6gASDMESDlgA\r\nXxvgwA0ucC8iXKFQwAAVp6Iw2UJtahhk5ZQzdkpQ\/Z0VszixyRUk1qez0SIThRLPLZ3AMkNxIgpA\r\nUMLGbEuz4oAoo0ULVdGq8Lbo7MIaukDopsryKoQq1woGHahz84QT1DoBBcy6gRCKYAISDAEsN7iH\r\nE2AAhBS8IHHTLdtursi1GxRBBkvo0gsSZYTC6NK5naLv+44wDC3UhAsKjI5lGCpaLPj3O3q6wgws\r\nKAQSrAApMqjPeUgAAv6k4Ag+CoEIOAACIvBHBEJ4AYv2+jqJdCApzitYQEBFiViEarOychmeTJC6\r\nFEj+aHceQat9n9s9aUqNqF2gzPrG5wUC2tI0viHyMHWRivexCn5ZMMZ\/FfLTG++yJG4hk4acK1qF\r\nMtRUNnGEgcF4BBasoARHuAEHDuCT82QpCxJIARaUBZUVcAADZU6BYifAAmwoywVWkMHvnGUCHQJV\r\nyljmXy+bKRyB0jfLDKWgQ0sphBKQwwlAGAfXahBeGUChSFYIqUTAgre0WCSmUUgcmNJBgysSAbOW\r\nRUWhmKaLsjzhFKYArTBOQVazTjahCuVejCBD1ChQoXybmZ\/\/eLLW\/5mmC\/\/LwhfA9D\/vnOZtXMOC\r\ntLjQzO0U9wo7IML\/WOkYhTrzfVogAhASmIVVLWH+B4zIQhKAI4z+QSxGOXioE+aMAs+t4Ae8i8I1\r\nr3KCIzoPAyswgj+PsDsZ7LUFGTjCBSywgQxYgLADm8ARxnqFFKBoAjYoSAc0kM6PnEADBWsC1zLg\r\ngA348QMiaAIHJsBJ4TGmCU+6sA4mt4U8l5JGPOgBB\/fxNZ7UoLsU7YGWgGCEKCAhIUbwgZV6AASy\r\n0KIGRcDSX21ABIYGsgYwoKnORCLZIyRBZ0XAQs8C1wONiiQLOOh20nR2BS1W5Abb0wYVHCqZI8zg\r\nB0cQQg12shAY0IjuN9jHDbSwgixtzAhFANEN2Ij1ULnoCIlrAt3j3u2JcEIm+CV8OyKnBS1ldGb+\r\n56rBEZyI+XXrIAmKakKqGtq9ekvmcnd1HgeSYgQRWKAQGLjAAxI\/AW1NIJ4t2EAHgPDExqYgkoRY\r\n\/gZY0oEkxF0DH9DAA3TQgtStheQkEkEGTGAFDUyAAiKIV9sf0AF5WWFEHycRDHRnggksohF2\/0EQ\r\niDqZYcfaMrKwhGbreymBVAmSMj7H1in8hwrFZSqvogVvYwtxVyVlsT8JqCLtVlr8A27R5hgxciss\r\nEASS4QQ8wAIS0F01IgJVtwQ9sAE3wANYAgMpUARQUAI1QFsiwAIvWAIy8BMvCAQnECswwHVkYQVU\r\nwB8SEQNUZwU2cHM0IAPpdAJXQAQ6EEJNkAL+VQADLgADKqACWZICLkB35eY3O6ADMQADk\/NFpXQE\r\n4AQCGwFhHmBnm3YV4vWCR2QFIgAfWHICvnNEKMACiOFhRwAUdvZ+cXdhdtg7OmAWNmAFmXcXCyED\r\nI1ADTVADSdABARdwFiYCH1AnjiMPMBADPXJxt0I59zcJw0YF5zMFVNBs4\/M\/oHFAp0GAR1AbXeAF\r\nX0A\/WuAFXqAFX8A\/psEFu3AFXPAFMQIrvoiBOGEapfEw+tUETXBxzzE3XACNWrAF0hh3X4BZeiIj\r\n92co39RNCoYBGAADNwcV9nIEHHB7vXNhGgADSxBwHKABIVAP6KgB3vQuTnhxUHACJmCHVsD+O12o\r\nNh5RCCcAFR2AhahwL\/jUjtUHWQHnhVBxA\/dUBIywBZQhBTnwgbIgAz\/ggjXAAiVgBAkBFilgA\/8A\r\nAzxABPkAAytAFulwAk9hBVDBAR9AFzFAN\/ngDFFAkCHkeNQzEdJyN+qQAj3kDBRVBO0QBUpYAy7Q\r\nhTWgAy9YHeXQVqK0BfW2c0UgBFEQCVRwVSDiBLbUJ4YSC1AwN1BwKSjWA6CSBTTTODkJKheXBTID\r\niziVBYV3lE3wBamSBamyPxRFM5Mli89Rd5tycRMUIywwBEzAE6RjHhcAAiC0YYWwBPZiZxCXLyfQ\r\nWAHZLBcGA\/YiZ0AwCHbRAUYQd9UiCDn+dE+IkC0G80\/SwhYwQHIDE34asDtrIQI35wKq8wH02AE3\r\noI2PBgVfkj6FsjFSNQqwYAlBUzSgsJxLUJIuVgvNGSrR0FunIHZHQAzOsJxxdzaxcCm1wDjVyQzQ\r\n6Uxx14zK0AQcGCP2NwTXoBNHKQMnsFTXJROxVlya9WpW9X\/CtSlnNVnN2ARJMIkUlQQFGgNWAgNj\r\nhwpwgYjnslNJIx3qJQxJ4IxHcHNWAhcUdCsYyQRSMAQXgAElsAERcFcXUH4dAAOw4FpQICuf4ASu\r\ndynXwFOF0ox8Q6MAei4EaTDf1wIfoANEQAE68wEu8AFHoBEZAAEuYDQn4ALp0gSpozb+9iIDH9dy\r\nM4kBM8CBG8oETDAJ1xAFUzAZX0oFRnAEBfhj9ykp+jNkjnFc4cY9ViAFTRCnRLANTaBoAtRMkmIT\r\nocII\/2OnW6ASpyE52ZCMfHMFVAA1ooSYXHoNWfACHgCIGJACLJAF4ZUCBLkq+WADC7EReuNncVMn\r\n+hAFMPABj6cl+pAbWyQDfKU2R8CEGhADSeACNXACJ8B1NZA3HOECOqAwWJgOOhCRXrg7HmlyIpAD\r\n3HMrVFBviuml8CAERFADQ3cOMCA9WAIFMBUFGFAeWJICGQAEPeBYIfQEahMWYRECLhJ3HxBwvaNe\r\nLRBwXZcv4bJ8KPBYL7gRdGGQL0j+ElDAdRsRcEcQBCwABFlgkVVpQVCASlRAP4eCDY0KBF9ZXFAA\r\nJtjgHYTyi1HABW+zRHNDWtCROzWxBXB5gcZkp1dQBMrWRY5haNngjBi7Vgt0KwQrSqI0A0FQptNV\r\nfmm0AlBQASBgAvLJj\/H3IDCwAS6EjnSBAgpDhRwQBfFnARyQARdAAROQOo1BBBCgAwdjRBmgASbg\r\nTW8hAiI0AQihAeshAkYwAmPLchxQqx9wL7DJAbDJAiMwAkFQkVJwdxw6CUAgBOLAAmUarcgXKmlh\r\nbqHSODH5Fl9CC01QMkLTIX1VETtgp3OjBFlHHS0gOGLnerbQCiDiNMUBA9SRAgX+ujGcMFK+JQWk\r\nRBkWyaFcegSSIAm9JQu+RaOlViWCQZoA2rJ8o16FQnerZqgf626TS1q824y54Uk7sAUJtQO8FneS\r\nFQMlWyhUcAVMIKerK0ocqpXScwLUEgEtwJIC80\/dmgET8HIT4AJAYIdFMAESIAHmmwHjCAEocgNR\r\nK36DIH1NIAFRKwEUkC4uQgEPID0mQAGSqAEQ4AHi9wFLIAiGQAE1QAQFQwEa4AL82L9EEAMOEAMx\r\ncooXmZhd6qX4x6JWwHixACZM8LpAUB1BoyorZihNQAWtICux9rrWQKOvyzcAFjk2JadxugNX4Em5\r\nIwyvixNtaad8cxyIil+IKkr+V7CshiKpz8p1MRADQKAPCCcCUAAWOjCGNwAENTACWiIDMaAwN1gD\r\nAHECY5gCRkA9uDpZNTADMfU4WeiFvBqtO7M4YggDOcARMSBZvgOJLsAFRWB6RZACXOxY3EO9iIqR\r\nksAEvkN1LEACLGADhmx6j7cEMoaHnRqPnYkIMqYBy2cDcSsCFPCC8nLE+nqCMEC1bfs7Q1o9JyCg\r\nJrADQ0qkEXkCJbAs6qUDjkUE+HICmggxoqSsRbClUJADMGwEu5gNuFgaihKXFGsb\/nMa4sEIZHqB\r\nK5sby1so3rENu+Cm3rwNSVAFomgFWzAMcZcbpmEaKYtZUtBs2MvIiams\/zL+AhhwYd4kAh7AAlFw\r\nMCJ0RPx4AkXAARfAAwUtAkCQASHArft8AiNQMETgAhxgpy53AnFrAxmAiBkwAk8EAyO3Ay5wArrj\r\nAlugrhpgAUPaQhigASXgAfzRmYIUnxowsHiLt08cBBNhI\/xRAh+JJUfw0XqThyKtN0d0Rb3DxnWi\r\nA\/0iAneRJUbQEReXhB89A8dhA1dgAztwAzRAq5MYrVVwAnm8bt2mA43Tr5NaAyoQkTLAAzYgsIgK\r\n13pLBVAQBFzKotN7DZNQGjEIBHJaKKUhBZGjG7VSK5hFsMdRBIDaCEUgqEcJhc14c80II+qZBKI4\r\n2QWajM2mDaVBsFk6s8r+egSua2fS477oOGcQcAGwygINAwEOILUioALe5L7xkiI6QAFRCwEXFgP4\r\nFEK6cE\/1eMAcVwMUMAIIkyIuYAEeMHLLvQMn4AEQgNIQYAMxELY1gI4SUAI64AEgqgEzgKw3HdrW\r\na9ep8robg5UqTN4gogMqTHlF8HVcTHc6cIJxnDiRIzOyIjQqfEWI2EI6EARRmLx4jMdSgMe2Krll\r\nBtlCoAI6YAXuDQMyYZGOoL1M8LdvdQRA4N9BcA1HybfrzcVAoOGlxsWvuwMWapT49bpZQMVXZC6I\r\nHTnHkQNEwARHGTmTyDMBvgMEXgNJ4wJjpwNXoAORowNcAKxk2HUQw7r+iemh2y1h3qc2WOmGIcBI\r\nIoABwJw4FJBGEeE7Ih3MJuAC8XkEKcCOH0AEcUp9jvUBFMCPB\/E7mbhJLtDc1RfWJ2ABRPoBuxkP\r\nvem2kggW63pxEb6spShsBFsa+P1\/2XCK2QDC2vHXhubbsfaKcWeeVGAFiBhtKTvZme5oW2AMVQAj\r\nk7VAoC5AtsTEeKusiVlqkyoCJVACHVADUIABeQgFPiEC5ADbRlMiMUB+iPjRLqACJQAf2FUDMeAC\r\nIaFeVxAEGvCUPiqJMdCFP5oCOx7SO1MDGrDjs7oDS5ntGhKtAXPIMfABKuABJbDIE\/TEQM0CHPCR\r\nfbVUNqiPF5aHH0D+AkaDAUYwAxxAAcgHc1HBH0fJjy8YkOZyBFsor0Ug0nee1gZZwR9Qy9XX8Ax\/\r\n8PyhYfnEAUX0ASnw0n\/OxDmwpYUiBVFAzJ+Nt8Jm6o7g8Zm1yNaLEzYN8s5wE3b68VIAYHH6HU1s\r\n2YmaqJ7+a4+hsqUVTSJflXVdSvjZoVDw8V7KU80Iwl1aozea9D3cw8Lg8UkvSnLajDOL9VJQzqJU\r\nzltfzpzy8ZMl8\/Rn8\/Omt0Y\/CVLQoVLQpXEaBdZro28\/o0g8o2kPoHFq9YYuK3GaWU189ZWt9Vjv\r\n9VkPp45g8sVbshOUvXV9zGzfodY7CaXErDKqWfht6HFv6DJ\/9VD+P\/U0ivfmGXeCn\/Uz2\/UyD6fq\r\nLPNhT\/alvqxrn\/Zqv\/YdisT4qbtQz1OTUKObP7NXj\/e9b\/UQ08Ojn\/Vbz\/WNAPIQk1CGf\/Oyt3PX\r\n8Piwf8x33QTS79cACve66\/RxWvXB36E41fvaL\/yBL\/7jL\/OvdvrUu\/JY37poDwVb+viPz\/Q2Wvsd\r\n6tcsWvtIjPfCsPvab\/UzO8zhDwhSgoNSV01SVk1XUVaLUVeQhYQ5QUxMUFBSTJqbO5xNl6BRTaNN\r\npqdSplFQh4eMqKemqac7hodbnoJJhLuEg4qGglfCj8DDW4KUlpvMzZazsadMrdHRgtOtqYPPUrXD\r\ngsi+4r\/CkLKNwoOQ3+HKy+7LnJbSstjVsdiCps+Hnue3nrnGaRMXTFK+SAWpDKJUyV28d\/I+6ZsH\r\nalpEUNTuaQtHrlsvKR\/ziTRV8NcwdZGkIGMI8Z2mitAwTruyAyY2ZjFHCgIIjRBHcYfGfUuXTpEg\r\nhVRyKG3JdFnFiu880dRXT1++JjwJBc3pK6jXrQMJHVMpBWkgADs=\r\n",
        "geometry": {
          "type": "MultiPoint",
          "coordinates": [
            [
              124.31666666667,
              13.783333333333
            ],
            [
              123.3,
              9.3
            ],
            [
              124.85,
              8.175
            ],
            [
              121.07083333333,
              17.441666666667
            ],
            [
              121.075,
              17.475
            ],
            [
              124.85,
              8.1583333333333
            ]
          ]
        },
        "names": [
          {
            "namestring": "Chrotomys",
            "identifiers": {
              "namebankID": 2480922
            },
            "pages": [
              35518840,
              35518850,
              35518852,
              35518853
            ]
          },
          {
            "namestring": "Tarsomys",
            "identifiers": {
              "namebankID": 2481402
            },
            "pages": [
              35518840,
              35518851,
              35518852,
              35518853
            ]
          },
          {
            "namestring": "Murinae",
            "identifiers": {
              "namebankID": 2480810
            },
            "pages": [
              35518840,
              35518841,
              35518853
            ]
          },
          {
            "namestring": "Limnomys",
            "identifiers": {
              "namebankID": 2481054
            },
            "pages": [
              35518840,
              35518842,
              35518846,
              35518848,
              35518851,
              35518852,
              35518853
            ]
          },
          {
            "namestring": "Apomys",
            "identifiers": {
              "namebankID": 2480863
            },
            "pages": [
              35518840,
              35518844,
              35518847,
              35518851,
              35518852,
              35518854
            ]
          },
          {
            "namestring": "Muridae",
            "identifiers": {
              "namebankID": 2480343
            },
            "pages": [
              35518840,
              35518841,
              35518852,
              35518853,
              35518854
            ]
          },
          {
            "namestring": "Phloeomys cumingi",
            "identifiers": {
              "namebankID": 2481256
            },
            "pages": [
              35518841,
              35518842,
              35518849,
              35518853
            ]
          },
          {
            "namestring": "Crunomys suncoides",
            "identifiers": {
              "namebankID": 6071872
            },
            "pages": [
              35518841,
              35518844
            ]
          },
          {
            "namestring": "Rhynchomys isarogensis",
            "identifiers": {
              "namebankID": 2481368
            },
            "pages": [
              35518841,
              35518844
            ]
          },
          {
            "namestring": "Apomys datae",
            "identifiers": {
              "namebankID": 2480865
            },
            "pages": [
              35518841,
              35518844,
              35518851
            ]
          },
          {
            "namestring": "Batomys granti",
            "identifiers": {
              "namebankID": 2480886
            },
            "pages": [
              35518841,
              35518843,
              35518849
            ]
          },
          {
            "namestring": "Chrotomys whiteheadi",
            "identifiers": {
              "namebankID": 2480925
            },
            "pages": [
              35518841,
              35518844,
              35518846,
              35518850,
              35518851
            ]
          },
          {
            "namestring": "Archboldomys luzonensis",
            "identifiers": {
              "namebankID": 2480873
            },
            "pages": [
              35518841,
              35518843,
              35518849,
              35518850
            ]
          },
          {
            "namestring": "Batomys",
            "identifiers": {
              "namebankID": 2480884
            },
            "pages": [
              35518841,
              35518849,
              35518850,
              35518852,
              35518853
            ]
          },
          {
            "namestring": "Celaenomys silaceus",
            "identifiers": {
              "namebankID": 2480908
            },
            "pages": [
              35518841,
              35518844,
              35518846,
              35518850
            ]
          },
          {
            "namestring": "Archboldomys musseri",
            "identifiers": {
              "namebankID": 6071871
            },
            "pages": [
              35518841,
              35518844,
              35518849
            ]
          },
          {
            "namestring": "Mus musculus castaneus",
            "identifiers": {
              "namebankID": 5474386
            },
            "pages": [
              35518841,
              35518844,
              35518850
            ]
          },
          {
            "namestring": "Limnomys sibuanus",
            "identifiers": {
              "namebankID": 2481055
            },
            "pages": [
              35518842,
              35518845,
              35518846
            ]
          },
          {
            "namestring": "Apomys hylocoetes",
            "identifiers": {
              "namebankID": 2480866
            },
            "pages": [
              35518842,
              35518844,
              35518851
            ]
          },
          {
            "namestring": "Apomys insignis",
            "identifiers": {
              "namebankID": 2480867
            },
            "pages": [
              35518842
            ]
          },
          {
            "namestring": "Phloeomys",
            "identifiers": {
              "namebankID": 2481255
            },
            "pages": [
              35518842,
              35518849,
              35518852
            ]
          },
          {
            "namestring": "Tarsomys apoensis",
            "identifiers": {
              "namebankID": 2481403
            },
            "pages": [
              35518842,
              35518846,
              35518848
            ]
          },
          {
            "namestring": "Archboldomys",
            "identifiers": {
              "namebankID": 2480872
            },
            "pages": [
              35518843,
              35518849,
              35518850,
              35518852,
              35518853
            ]
          },
          {
            "namestring": "Batomys salomonseni",
            "identifiers": {
              "namebankID": 2480887
            },
            "pages": [
              35518843,
              35518849
            ]
          },
          {
            "namestring": "Celaenomys",
            "identifiers": {
              "namebankID": 2480907
            },
            "pages": [
              35518844
            ]
          },
          {
            "namestring": "Phloeomys pallidus",
            "identifiers": {
              "namebankID": 2481257
            },
            "pages": [
              35518849
            ]
          },
          {
            "namestring": "Apomys musculus",
            "identifiers": {
              "namebankID": 2480870
            },
            "pages": [
              35518849,
              35518851
            ]
          },
          {
            "namestring": "Carpomys",
            "identifiers": {
              "namebankID": 2480904
            },
            "pages": [
              35518849
            ]
          },
          {
            "namestring": "Crateromys",
            "identifiers": {
              "namebankID": 2480936
            },
            "pages": [
              35518849
            ]
          },
          {
            "namestring": "Batomys kar",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              35518849
            ]
          },
          {
            "namestring": "Rhynchomys",
            "identifiers": {
              "namebankID": 2481367
            },
            "pages": [
              35518850,
              35518852,
              35518853
            ]
          },
          {
            "namestring": "Chrotomys gonzalesi",
            "identifiers": {
              "namebankID": 2480923
            },
            "pages": [
              35518850
            ]
          },
          {
            "namestring": "Cremnomys",
            "identifiers": {
              "namebankID": 2480940
            },
            "pages": [
              35518850,
              35518852
            ]
          },
          {
            "namestring": "Coelomys",
            "identifiers": {
              "namebankID": 112584
            },
            "pages": [
              35518850
            ]
          },
          {
            "namestring": "Crunomys",
            "identifiers": {
              "namebankID": 2480946
            },
            "pages": [
              35518850,
              35518852,
              35518853
            ]
          },
          {
            "namestring": "Crunomys sun",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              35518850
            ]
          },
          {
            "namestring": "Rattus",
            "identifiers": {
              "namebankID": 2481308
            },
            "pages": [
              35518851,
              35518852
            ]
          },
          {
            "namestring": "Tryphomys",
            "identifiers": {
              "namebankID": 2481419
            },
            "pages": [
              35518851
            ]
          },
          {
            "namestring": "Bullimus",
            "identifiers": {
              "namebankID": 2480893
            },
            "pages": [
              35518851,
              35518852
            ]
          },
          {
            "namestring": "Abditomys",
            "identifiers": {
              "namebankID": 2480811
            },
            "pages": [
              35518851
            ]
          },
          {
            "namestring": "Nesokia",
            "identifiers": {
              "namebankID": 2481202
            },
            "pages": [
              35518852
            ]
          },
          {
            "namestring": "Millardia",
            "identifiers": {
              "namebankID": 4935005
            },
            "pages": [
              35518852
            ]
          },
          {
            "namestring": "Hydromyinae",
            "identifiers": {
              "namebankID": 5619107
            },
            "pages": [
              35518852
            ]
          },
          {
            "namestring": "Rattus everetti",
            "identifiers": {
              "namebankID": 2481318
            },
            "pages": [
              35518852
            ]
          },
          {
            "namestring": "Bandicota",
            "identifiers": {
              "namebankID": 2480880
            },
            "pages": [
              35518852
            ]
          },
          {
            "namestring": "Rodentia",
            "identifiers": {
              "namebankID": 2476907
            },
            "pages": [
              35518852,
              35518853
            ]
          },
          {
            "namestring": "Chiroptera",
            "identifiers": {
              "namebankID": 2476934
            },
            "pages": [
              35518853
            ]
          },
          {
            "namestring": "Mammalia",
            "identifiers": {
              "namebankID": 2478620
            },
            "pages": [
              35518853
            ]
          },
          {
            "namestring": "Pteropodidae",
            "identifiers": {
              "namebankID": 2477081
            },
            "pages": [
              35518853
            ]
          },
          {
            "namestring": "Heteromyidae",
            "identifiers": {
              "namebankID": 2482860
            },
            "pages": [
              35518853
            ]
          },
          {
            "namestring": "Cricetidae",
            "identifiers": {
              "namebankID": 2813429
            },
            "pages": [
              35518854
            ]
          }
        ]
      }
    },
    "2006": {
      "biostor\/65879": {
        "_id": "biostor\/65879",
        "_rev": "1-fd1fb6618ccd1deb97a245142d0c11cf",
        "author": [
          {
            "firstname": "Lawrence R",
            "lastname": "Heaney",
            "name": "Lawrence R Heaney"
          },
          {
            "firstname": "Blas R",
            "lastname": "Tabaranza",
            "name": "Blas R Tabaranza"
          },
          {
            "firstname": "Danilo S",
            "lastname": "Balete",
            "name": "Danilo S Balete"
          },
          {
            "firstname": "Natalie",
            "lastname": "Rigertas",
            "name": "Natalie Rigertas"
          }
        ],
        "type": "article",
        "title": "Synopsis and Biogeography of the Mammals of Camiguin Island, Philippines",
        "journal": {
          "name": "Fieldiana Zoology",
          "volume": "106",
          "pages": "28--48",
          "identifier": [
            {
              "type": "issn",
              "id": "0015-0754"
            }
          ]
        },
        "year": "2006",
        "link": [
          {
            "anchor": "LINK",
            "url": "http:\/\/biostor.org\/reference\/65879"
          },
          {
            "anchor": "LINK",
            "url": "http:\/\/www.biodiversitylibrary.org\/page\/2853545"
          }
        ],
        "identifier": [
          {
            "type": "biostor",
            "id": 65879
          },
          {
            "type": "bhl",
            "id": 2853545
          }
        ],
        "provenance": {
          "biostor": {
            "time": "2013-03-11T17:25:11+0000",
            "url": "http:\/\/biostor.org\/reference\/65879.json"
          }
        },
        "citation": "Lawrence R Heaney, Blas R Tabaranza, Danilo S Balete, Natalie Rigertas (2006) Synopsis and Biogeography of the Mammals of Camiguin Island, Philippines. Fieldiana Zoology, 106: 28--48",
        "thumbnail": "data:image\/gif;base64,R0lGODlhZACdAPYAAGNmaWxubmxvcG9wcXJzdXR2eXd5eXp9fXt+gH6BgoKFhYWIh4SGiYaJiouN\r\njY2Qj42OkI6RkpKUlZaYl5SWmZaampqdnZ2gnpyeoZ6hoaKlpKaopqSmqaapqqqsra6wrq2usa6x\r\nsrK0tbW5trm7t7W2uba5uru8vL7AvsHDvre8wL2+wcC\/wb7Bw8PExcbIxsnKx8XGycjHysbJysrM\r\nzM7QztDRz83O0NDP0c7R0tPU1NbY1tja19XX2NbZ2dvc297g3uHi397f4N\/h4OPl4ubp5enr5ufp\r\n6Ovt6vDv7u7w7PHz7vz\/7\/T28ff59Pv+9f3++QAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\r\nAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\r\nAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5\r\nBAAAAAAALAAAAABkAJ0AAAf+gExPTIKEhoODh4WJhkxOTkxLj4SQT06Jj5CUjoOaip5PiaGKo4ih\r\npaepqaSLh4yGkLGTk46Zj5aWnJe6lJW3n7CEp4KoqsbGwoqNy7mysbVMTZmdtrfVl76OhcGmqsTF\r\n3qdQyKKmi6XQls6zuOqXoe9Qt+q57dbDu9vnwsfG48OvViEqhK0bNm3YnMhTmFAhrmkP3bWD1Qlc\r\nv4viyg3jBw9ew2nVniy8JU\/kO4kJ7bm7V5ARxotQxkEh9u3YrlPzIlqLBxKkyZYFbXU8mOwlTG\/f\r\nauJcmeoa05EpSQJtGVHiUo1GM45rJRDnzqArGdpauFAd1H\/vojZ9SPSlUpH+SLOqAmqSnrySQtOi\r\nHMqXZTejMjOK\/HcO48l2damSvYQWL5DBUIAg+ZcK79WjlOEOhku5MGdxmWMyzvQvpuhHMc0qlAkE\r\nShMlUIIYkXlXtNzSoUynhqwbXWXcmlXZHop6MMPapp\/4cGLEReTZaR3SO1pZc+rMuVF9o5x8XE6G\r\n08ve614Sig\/XKJ4AgX4YLuPQ2avrpt29GEf6wVdf574b70icMfnwRBFFRFYgaddIJ5xgpQUWXFwL\r\nNsibdcltNp9pJ\/2jg25EHHiae\/0Al11otFlokYXcAZjacbWBJ1pvLwIBxBBDHJHDEmeRhBY2JObm\r\nYH\/kNKKVYOLkhAt2173+x5s8RSChhBJiabaaXPH5aN1nAt33G4ALrrWgdGLpR9ZdqhX3nz+f7bdZ\r\ncEIKgl9pDjWI2oV3SSdeSWUuVqc73l1Z3Z+Q3aZViRIGppt+8ex2GILHRVflkUTGR96S2v1JKIoV\r\ntvNieXW1iKB\/qynYUaRLNtZfZq6YuOaEmvIWKov7YejQe8nh2ASOF4pkBI6DEQgFD0TMN5lpwWZW\r\nCRRIIFFqTEpMxhsSO0DRwgw+JEGndwwt4YESksijRAZKEDFCDk4cAQUFMGyAQhNG\/PBDET74YAQS\r\nG3iwxBM8AGFAEh6IUEQNOsywAg0l4MACDTKI4IIOoyQDRb075KDDCTr+wODCCTPUEEIOUORwcQsc\r\naABFAg6EsMIIIYRgAgr9przBChmAYIEBHGQAhBIXUPDAwxkoEMEJULzQwAQfREABAQlIkIABEzCt\r\ngANOPKBAAVA4YMLIAixgwAIXMNAzAk1LQFhFQGhwQggjKGCBBQ9YsIEFIWQAhQcSeJBBAyFAEYEG\r\nHHjgQQUccIDCBiBQAAIMK1QAeAYjoACEEyGg0AIUNMzQgggM5+sCCh+gQIILNIQOwwk18NADFDvw\r\nAMMTTcBgxAs06GCDDj84kAEOOvBAe0z3KfHED0QsUYQkIgQBBbdNHN9sE8rKswSuO8xwrzwt\/CBT\r\nC7A58ficuS57bW\/+3jeR\/Hy5EAMFCjVAMYKtTxgxQkwo1IwCEpf70GQRQORw8xFHkBYraowJj\/88\r\n0pTdWAk0nKGPawJDE4W8TWYhWBsFKDCBmPSNBgiQQM0ywIAIVEACEUiAAnKWt0Odxn\/+8xT5LEE+\r\nCfnoe\/tRBBRAd7ETdO4EIziBc2DwgyaI4ATTOkEDXGABHmQMYEaIVk9MUqdXARBPTJxTohRowAYp\r\nEB73+R6tDrWcYrVQKiPRU6hOQxuxeAdbDyLUtTbzFjiV5TovlJKP9PNCRC2mUaHiE4auuMbZGK+F\r\nItnEb7Q4KzGZ5gePIQKURKNI1xAhFOZCjn6WcB4oECEFTjhBa57+sAQXGG8JMzAXDTQgPBs8QQjJ\r\nI4EQTvAIa7kgknDZDgrmFQQfuIsIOiDCDoygBAdwjAYcKMEQdHCDGeygBkkgAhJ6kAALrKB6SgCA\r\nc5DAgSFkgAItMIEJSpCBDpiAAxzzwQNOwDztTWCCGGhABCSwASdMoARzAwAFHKCADlCgAkJYwmya\r\nwAAIOKAAXkQHE6BAAh1wAAQeMAEIVgC3EpCLAjNwwg5OAAKFcgADJZgBDczlgw6coAMbW4IGauC7\r\nHPBgA9kcwQ1aMIJxuWAGShhCDobgruPRAAig06gNrHeEHyyhp7kTAhGMEIQdbAYHQhBCD8bnG4\/g\r\n6oxPNOQPhoX+hHms0ZDXMuQLYchVGNbiFC5wwROI4AMlmIAGk0nZTIkAhBnk4AcyHdamcpPHF6XQ\r\njCjcEXj8wR\/8lKqpRehXBURgAQxgwANQsADjKpCBlJXAsMFi0ZToCsAEWTYvPUkJW0YzlrRUiCO5\r\neZIToFQcS8B0j11NrWpXy9rk0AQekrjVaJ90BCMQSAlFIAIRaDQEGfW2tz+Ilw5ykINizsByYW2B\r\ncpWrzRAgNAPQxUAFMGCBCqzNutKtrgTm2QAGKAABBjhAAQggAAEQYAAEIMB41VuA9hZgABDgnTAU\r\nYoEDJAABCEjAAewrwgQkgAEM+G+AA9yA7jbAAQVuQAIU7AD+khlNcYa9AHQnrFjrTpgDHQCBCEJw\r\nghWc4MMgNgGIR\/zhFKTgBWE9LgxCZ4Mb3IAGlbTIFFtL4xrbuKugDZR1rAoPylgWKkyxrDQuOw0k\r\n9VgvL9qqbpRiKDiWZz5i2qIhpSirC2EVRns00ZuQk6v2wHFE9SEPIaEyxsqaEFZjvJKT1wxIUWyH\r\niqYq1ZQkuynUmjmqTVxRC9U0ogmtELR8VGOF4Gxnyb4qz2Hc45QchCJK0SmQTLbiX5NsQi7bscyN\r\nUnQTA5hALQ9JzLl57aCwXOn9GPrMZNRTnca0aq7qWE0rHIib\/ISbQiXQrpo2YxjDRGc00xlJsKZT\r\nG08VqGD+l\/rYm66ypu165TetydU3mbWkOj2pHm+mzKt2YmWxPeVU83nasZJJqkAD7N8g6j2fYjWi\r\no6prPH4oTbfe8pe3U2xS05h7dc60qrft7UINGnxAGjcCb83EOKJWgZJNQvZWIw1cs\/rK7ekzcOaN\r\nimNjis17OrZCjhAzDHQzZSCwlr5bJMkbm2Yb5K43ZLDqvVSTpgk56AFxf0DcIfx6T3NuMqkeffIu\r\nObvOamThlhfd7GxnvKvPxjiMIt1kLWoZ6KpNN8+nXuMsdYlbzpMJvhc9PifgaLZI6J93jOCEGtHo\r\n6zg6ApSWoATxIUEaRiBCEpzwGtdYQnw+aEIShpfUVhr+IQnJYmpquLIkF4jAB8r1AQ1e3AIhOIEG\r\nLQAYDXJwBMQ7IQfUunw2TeADJBB3BU7wQQ5agAIagHIENvrB5kVgghG0YAknKAELZHCCHzjhBUk4\r\nQehcIAPZ40AGOOBBEoAP\/BKc7rM1iRXz2F5VJLBd7cd7exPUbonJsF3knWX3I5rgHu43gQi3St4j\r\nlpC85IWCCPoxAifPqJuGfxYg2VkCEqbKP2X6oAd0p9G7wl4Esw9BCUcgI8FVI0dAI0QQXDsQLzlA\r\nA7ZXOT6gA0pQAz4ggcvxAqK3A0nAAjCwYjbAAjZgAzuwYi8QBCcgA0LwAyv2e7izIRQ3SLvVA\/Ei\r\nevf+N1NDMAM01QMFSFw6OAREQFzTwoO0MwRCoAOx8wM4WHlLMAS2RANNMCNA8ANG8H07QARBkAQ8\r\nwANBACw84C5CkDo8sAQ\/IHw6kFRJxVbBsiZvEUUA+FRQ0C3lMixzl2yT8X1z50RDJj7bZwtHIA1v\r\nR3fhAnhJID6A10N7KA1JEIhFAIiHKHdJUCVM5wRCQC4uNgTTMnozdQNCcAMqoFyUaDnPtAIxUAJH\r\ngAQ3YAIroALxslA3EAIuIAS\/twI+IASgIwM\/oANE6AI\/sAMt4AI1IIsucIUyIAMgIAMwIAO2+Hsk\r\nKAM9YAMlsALFKAM6xmTGQRZLIARtt0jVIH53SHf+0rAS8tA\/mQUP4uN+XNZ+GDI+qFaOcMR0NOIE\r\nN7BUQqACmdgDQoiJqJQEmGhzKyADTqADK3AD8ZIEuNOKTaADMgeDN0AENOACVZWQRGCC+dSPLzAD\r\nTeADOGAwINADOPArLKADMpBMBvN7sscuJYgDkzUQwgEFveUEMhd2BZg\/7xiJQtA\/NNV2PrCHRNBT\r\nQtUEwOMD6KdbPyBUynSAPzkZujVUlpSAUJBbRZBU\/ON2STAbUBCV84IEhziVV5kp52BqdGcumRBb\r\njLKHXqcQ0iANQxB2Zfl2CjeTT5IsbwcFQpVPybIESaADTgB4ZUkgSXAERCAESDA8OhAEegd8LOD+\r\neMo0imqSRaaRAybgYj4gU8vVAy7mVk1gXEUAeTOABDHQAiqwj7PnA0b0Sr64TYuHAyWwIROjQwRD\r\nA0ZQAgvJAg8ZVjIweyygOy5ABAaTkzWAAwiTBDRwkcfXggjUWZ5yDQcXSfKAji83GXZoGnSpbLdy\r\nKMzxBFkZE+QIPoH0JXA5UwXYAo8Jg6IHgTTQA4unAw\/YeT3QAjB4m0dggzcwhhPzhDQQAz8weUBw\r\nA7k4MA+peDDwAkXwAyjwezRgAzjwAy4ge0bgAbN3AizQoEQQex\/JjC5ARzPRDS+CBDQSUzSCobz1\r\nOHA1I0NAIEMAc\/RIU8mCfjyodmQXdlbpJIf+GIjJ0lPMY5Vz53h0+XdLMFSTEXeA2CTMMy9JAIXW\r\nYkAWChluZ3Oi1T9HIH\/8o3DJAgUB2D97+QjOlyyP0HlOMqPSpwR\/lyxPMJd\/ZwNCkAQ5KgRGEDsC\r\nKXfAQlRVZYI4QAS6M6YnOGiesZgr1QKj1wJFgJ+dt1wqsInYMwQ9gIrHFQMSkwMWeAS2GASTV58U\r\nA1ctEAM9IJnukks4YAM0cIWXuWI0EARFAAM4EARvqpGnQzu6hQMwMKY\/YAPgk2PqSJZdlz2LxGpC\r\nR3fHI3hQykTi4xrTs6tIYDyJOCFsWBtSaY65MjbkJnotcAOjl57KpQQzVTnHZTkzIJMx8Ez+x3UD\r\nJ3AEN9ABCWmKNyACAxMxuyhiO1ACCcgBOoACI\/ACIvBDDDqbRSADLxCMMpA6MuADJWmCxAd8Jtkb\r\n0hgTgBh4o7iXQ8YtlMQ\/o6h3fDlaiyg+o3iXLKp2bWkEtfV94iN3t5IsQSAEQZAsMJqI8jB3aal3\r\nriE+qHSS4EAbzLOkQ2AtGNoEZ1mANZI\/KrlRPhl2PEhT4BeLQdmX\/ZNLRykZwHOATkBWTRkENkAE\r\nNhCI7xIEyhR8HtsDOtAEqCQE8SINLNCUrfpmqeED\/yh61igEZxlzksmsLnaXQjieMKcCuPOeSIAD\r\nmCi3togEOoAEMkg7FommuEk7v7diytT+AzOJmyyAAxCKA3XZlwYJfrhTScL5LLByQiM7lcwpK1j1\r\ncmXneHjIHYAHq44kdwuEjlAqct5XuQtUH3+xHzsgA8UUAzdAIy2AoXjqrAWYUTfgBDHgumOqiTNg\r\nl5qYAzm5Avj4AjfgAhMpA\/N5AwIpmyQAfFDAAgrKoA3KoLXVAzxQArInAiUgAm\/KAhk4e62akqEw\r\njoGIGuJHo5t7lwxRTiUxZGKnZ6HbSndZJ5v7H5lQfqELBbZlsnu0q6sySCqZVLwluDQiBFDQA6HE\r\nW+1oI0lAI7akTH7JhX0pBC+guEYwAzdQmUJAi0GJtUagA0bAAywwirmUS0EKtQUZtzj+gAS4SVb3\r\nx5f\/uhuuKg+RqJ4IHJOTColkG4tK2HncypfEtAM3MH+45JNYW6kLk4A3SVbmWanCh1Rx+7GhioVB\r\nWosFCbWC2wSCm1Sdp1swsrIxYZV0p3DyMBkKJ0ViUVVQCo7WYLXBgyzJ2b7cR6VF0D\/jY7K7epdx\r\n+H1zKH7qO5X7FCsWYRqaKLiAuomZeFyQqVw\/YAIxgIrFVUz1ugIrcJs\/hL2UbAJhhQQXkwMr8K6z\r\nqXvYawPB2KCFqwMs8APA1wMnIAKzaZANqgO\/xwLDGIxxMsgsdHfYQne8nMfj6yTz4X0f4X3i03YY\r\ny0lzJxFTNWRkwczPw33WMo6pkQT+xICrfzFHOdjDHdKGGYl5k7ocyqGE+ElMQsU6rEsDUCADsPie\r\nwOMEKDAElfMEtliEipcEQeACwYc7llS4xGiVMBAEtbkEOrADuGPPyHuRdDTI3lJ5LNwhRzB3cKVb\r\nAtx8DSyUSaWWTQylttRTtaWSRrCSfBkERyAE8EJ+HqtbPOAEdptUMjAZH7vMQSAbPCA+nVqgOnbN\r\ng\/E8ojV3I4osPnknOmBzdFdVbucQVvmTRfAEUCJao7UETKjHgQh4w1MEs0F2UanSIAt4gxAEOdqG\r\nM83C+IYVuiGZC7hSKzWTQhADGOwD73g6xCWpyzqErKsD\/VPJLpAEPuACN7DCVGv+pvjsAtUIAxoo\r\nA7yngSwAtTLQLq5YgrEHA7Tj1A36eIgryzjwIMMmGsoZZSNnd66hH9dpG3FcGzgyL9cSiF83Ps8z\r\nDkN6usfaGaagG5nonaKXA44nBBhMLR2DA5OKeZ58BE+g1jGAfg84hi+gxEQwxK9TAxrlAxMFicrN\r\nm2Qqt1AAAx6AAhu4YjVQA1zNA795kR0ZBLbokVJpdXMEpW8Xo2Kns2+5lxTLP28Zduin0nyZoy\/K\r\nwslTlUhgW9BBVEg5VuiXo0FQtEEJhchCVD8AtbnFwkgwpl9mDiOiTKGnpGG3SCyqlirteD+AjXsZ\r\nLXwJeKP4lkdLozk634moEAb+G3axcYgEItzWEphTakkqfojyp5WpGyBCuMXzuFFwuVuOGTDFhHnm\r\nktZ6bUkBw9bveR6lSEw3YIw\/gAN5XQKOV9iZCgUfhr3YywKYQznEWALW82E0gAL2yo80viWwkczn\r\nGCpwWIffU53niH6BISZzOawXYi05TXXm1xXkBgVutYnF9Lpm62LFO6Lq2efD9VKue7stUALvGFYJ\r\n2QS\/6QL\/OJtCbLc3AJseCQM8UAP4jIJUOHutWILgjTCiWAMHQ9iMndA4bZ1q9xpOor53qUxVtX17\r\nuLBO0nbnDbJv6HXNEnjME4jTF5WSEHgvKn\/Ds3fOt7+AJ6rkt3d7F3ez8Rn+M2xJN4Oh7q2SP2At\r\n9dmXO2AuPUhzAAkvRsCsCoG3kDhUPsWTQmVJXahbBYIENeAE7mIEQiDPJ2g9Tg0DTVAEHxvVXaoQ\r\nfzfTFiJqsL1bNCK4\/fOOReDoxERM1kOKL7Z4EYPBM2UezlGfsfM8TfwEs1eE\/MgD0VJUAx0bhA0D\r\nkMibLMB7sUM7YsqaRmDKJymNZOnmJ4Qa\/bNycKzSitKGAJQ8aux88sAe425HqeHs1mka6Gh+qw1q\r\nDVOklnRWoQOQCDxTSOCJBYnBTfDIaj2Tam0Cu1jpP3AEJVCXYeUCLHACJgDCF2MCncQCxlT2BcmQ\r\nSuABIyDYsxmMVVv2DFP+Arr3YddOewlNeGfeh1PJh3eILapNpQsxZGZRh9snPt2iT0T9PHRpfRRu\r\nBJZvW1SNIx97L8WOo1gZjVtpGhAYL1irVKeDeDDFrSfYwzZHeUlVt3ibi2TlpnUMlB7fHMkCA31Z\r\nBDwgBMCiSz0kBDSQk0ggA0W1Awc+pnEHtXKaS6wSsE7ymJnIxV3p+o\/pLkAQ1HgNifFyAxabA8xN\r\nVrzJmqGOqZWTAlB7ysf0m0aEvPpuML1PAzUQjK6IgTCwU02+4E1eH9IoEvnNOoDgJOSk5LTklOSE\r\n6ISU2KSY1PQIRfToBJWEhKkJeXlJpAhllARl2AQFtVSamnS4OokK9QT+JUl7eor6pPvE1MurG7vz\r\nctNC1DOTg5Qz0+OTk6PUguyc05OzcnO0suLSoqJCRKSywuJTs0Ij49LkIoKyJMPB4wPCInMicjJj\r\nhMKDw3LDmAgWLP4VwXGChYltJY7QYIEr166Juww9IYXq0qtVGWNlPHLrFLBSoYw8OuVJo6JJTVRZ\r\nuiTpFhFbTZ7EdIQEkkddTHj23AVlhxEdN3T0+NGjh5IcPmj8iNEDiY8VOW4w\/YFEBhEhN2LcEEJE\r\nBg0fN24keeEioJByRWT80OFPBxIcOJDY4CFkBw0kO+rR1aHjB1YhPY70wIH1iA4iR2bJmvXzp+NU\r\nS4ocMXz5iJMhR3L+Hhni5PIQIkU4JwHFWIiPJke+CnndhIiPHUvmWfZxRMiPcElg+0CM5MeoGjpg\r\n4KhBI12RIMnpaiWiA8egWLskj4QiNXQSkEeUHFnyeckP0DkTaXbyQ4imH5mQICGCpEn8lj+WZEKk\r\nwwnKlfoT0dI\/iX6ouAcFWKhUUspJEVVn3SyzkJWDCl\/d4MMPLTTTQlk0DJGDbjO0IAQUzsSARFkz\r\nqECDDi70wIIKPPxgjzpC8CBDjT3I4IMPNeLggj07BCGDPToQxIILJ5Rw5AoVDrSCCkVio9FjPUkm\r\nS0erqORJLKF0FIoiDk5GkkccIZLRlrVsFEsiAJKZhJoC6helYzz+URSLDzM40dUMyCTVhFVW0bDE\r\nEDHgSUwLUPRQAmAzvODDC4mUgCIUOgxDgws1OCHDDTSImKIQScRIgxM67AAXDUE4sUMT\/8TngqU0\r\nFBVdaDjs9MtEHun3hGZtuqfJTYko0esRPlzSGSGdZUJKZgXuQEQQYOVaoRNBBIEVFEfs4MMgRhTB\r\nA7eHDJIEbXwVkeNrBiLRg4OPzQmMY0T8kBtjnDUxhBBD3DuEEkrgCx967xUGXyPv+uBeY00E4UMS\r\nBIt4SjiPnNaYfkFsC0URmYzyxCieCkjJETRRl4svQMXCoWo+6OBDVExV04IPQywhBFP2lvgDeje4\r\ngFQPRNwww83+LSxBRKWt\/sBDCTTsIMQJbv1wAwuM1VAjETuIIAMMLmj1Dw7prBqECkH+IwMuDFKk\r\nLiaqqITELMQqAUxsW8YSESy5aGllKEss8YQiAto0i39zO5G3IkwAjsQhLQEuUXVkU3LDCy\/0nM1b\r\nSLhAw4dDmFOoDjOsoFuGOjy0+QwlArZEj0dfzQMRJyBBAwworP7DC8khMUMNpLoAg6aAgwmymHOv\r\nWytFS7zEn02m2HT3wweD4h6wSFyWE9BLGLHDe9bfTUSuRFR2yBE\/tGSEEUtMG8S7NVU595foo88u\r\nlb6\/Lybv8O\/0vvzzXxf\/l2QDRScvU+oyvmaVj3zlQ9BjqtT+LgQCT04jS9xENKK2jqiPTgos2\/ou\r\nuL\/KhA8J4dvgeyC4vt3hTyIH1J\/+ohS\/\/PEPgQlc4O\/W9b+fZORsl\/CP+gwxvAMSTiRaWkneqFMR\r\nDrRKBn3xwOdEQIMXBKGEv1PfAZ9IQomIjCLkwtapWmWysaBKfDH4gTNGpQSo7GYxopgUDZpwsh1g\r\nqyIegMAHTMABCTAgAifQgAYYwIISjoR\/6loh\/hgoGbzVAj66YEQRhqcI+6jtEKd5xPM4aIRK5MQ9\r\nd+tM4XY3PxWy0IQmZKIfI6MLar3ABkmwwQx+wCwhpAgvSXjLDX6Qg7qUzglkqZwOhtK406ASlTMh\r\n4WRaSKv+kdlqXUyEH2T+B0BJzEISXUqkYxwZH1MA6CSGG97d7kaKdlVETgqkXwsn+EQwcVNxMmQk\r\nN4mJw\/ihMJOh0F8sklMEaZVgB7YrwlaKQJ8iQLIIT7imNc+GPFLEpkA8wAgo50Q7wBBNB3nRQW2E\r\nEAQRoGwHAZHUyW5gzxtIxWVCQGP1ArODHwCPEjtgwbZ0kAIUwCAFJ0BBCdgjOxm8AAZn1IEN6MIj\r\nrNAmIfYAWwlKAALIBE8WemtCK8KHzX6WIpLyqY97jECwR2hmCdZDnigOqYld+C0j2aTqJQCYkZag\r\nAheqeAxMQnImBCKzCKTCFg9Q0TMeIC2kOyDFWCoEBR7+BIFZRwgHvFJRIVSKj1m0mYgLZNcjFxCh\r\nBi4IAgxEEITi\/IAEOkgCDH4AgxNE9i4u4EENCqqDGrAgCIihKU5nBQXJ9ORuhijcSUZhH\/sIwQhP\r\n4BUnqBrb6WXPEJEUXz+lNxENbpAyqTikfS5G1YzxAAlFAII9g5CCICQBL84tYHpy4zH\/tasIQhhV\r\n9VT5nhpA5606kAEOKJScoxGTgX1s7y6KwB4eRJJo1KqBEYLwBBsIgapJWE4qHFoZ6SKhfJhok+FI\r\n0abzIbOQD8ubK\/SGN8BRlQijaIQItbm\/\/eVVn9EhldZscFMbGAHEPLApDGxgsRTYALosOIHj9lI1\r\nGZT+oHwmjZFIfiGZVvQuS71LnwUTR4s\/7gK\/P6nJLEzywrvRopvra4kkTHISTPRyitXhVnffZQOi\r\nfVYITLgvVN\/FGGqlBztHi3CKfmDfJ8DgBWnTBTt4NOMfJCcJNFDpC4yAAxLo9wM0qIENWAADJFwW\r\nSDYVT4txUAKqwQiVWWWXVXGo20PYZ1r\/vFsQKq0JTBhhd\/p0T08GTFtbKVUWeKNFK+7WiC4XbmJJ\r\n6PISmIBqXbSpgy3Ra3xQYR0o\/OAEpJIrwV4wKode2ggcDMcSiPMi\/BbBCCXmAQ8qw+sK2eBHRrDO\r\nXCubOhvcUgfLKSil3yO+JEjX1pemKrMtdqqtyOD+CKeRIlD8qWN\/1gTWr1bC8JyXPENMi7mtUEIQ\r\nimBTam1vIv+Gj5xfRCMU7EAGQbABCQD1gxV3SwZFAPifqRWkF5wAvhHlKUFwTeUMi9zRI6cgEPd4\r\nwV64u11MkEVP1GpB+82pQfujueKCV3KK2NzmExEZz0XeY1zPvOfkJNvPFbfAkJf86CQnOobtR2Wm\r\n5xzoGXbg1G3uQBkm8DriFB4N+Kn09jX9CdPKciS7FRx94g3ckZx0f2mLT1f487dFHnBs+ebkXBii\r\nhnATenDlW3Odj7x8MFAjPUeVHFI94WgzsIELAJMowAQlpDAQhQdSQIMnFAcFmyaICEoAg8rr4Anu\r\nRWjxjKEAVB9AIS1QIIiDFhz4mweP571owuD45gQmKJNvPEECrGuCarz1m97EZsJylACEIPCgCeIj\r\n4PZgy\/zGbMXqU5+5Lw6qWkf\/fJMjpznWe2c\/l+N8\/Nmv1UFFzvQGlR\/Hshc8H7cOMthrv31TiiH7\r\nkYl9kntf7OZv\/\/hF\/UIwNDZi53P4h3\/+U39GB0q9cIDWkYDuJ38rhEFRFxkOaH8MiIFjc33X13\/8\r\nl30LWHTalX0sxGQXeHMZuIEpiIEFWH8FGIIp6BNDZ4LWV3XUAYIoaH4tyIAIiIIr2ILsl4NAuIE8\r\n2IEx1CAuJAuBAAA7\r\n",
        "names": [
          {
            "namestring": "Haplonycteris",
            "identifiers": {
              "namebankID": 2477137
            },
            "pages": [
              2853545
            ]
          },
          {
            "namestring": "Megaerops",
            "identifiers": {
              "namebankID": 2477146
            },
            "pages": [
              2853545,
              2853562
            ]
          },
          {
            "namestring": "Bullimus",
            "identifiers": {
              "namebankID": 2480893
            },
            "pages": [
              2853545,
              2853556,
              2853562
            ]
          },
          {
            "namestring": "Cervus",
            "identifiers": {
              "namebankID": 2478696
            },
            "pages": [
              2853545,
              2853562
            ]
          },
          {
            "namestring": "Exilisciurus",
            "identifiers": {
              "namebankID": 2481897
            },
            "pages": [
              2853545,
              2853562
            ]
          },
          {
            "namestring": "Tarsomys",
            "identifiers": {
              "namebankID": 2481402
            },
            "pages": [
              2853545,
              2853556,
              2853561,
              2853565
            ]
          },
          {
            "namestring": "Sundasciurus",
            "identifiers": {
              "namebankID": 2482064
            },
            "pages": [
              2853545,
              2853562
            ]
          },
          {
            "namestring": "Tarsius",
            "identifiers": {
              "namebankID": 2481566
            },
            "pages": [
              2853545,
              2853562
            ]
          },
          {
            "namestring": "Podogymnura",
            "identifiers": {
              "namebankID": 2479441
            },
            "pages": [
              2853545,
              2853561
            ]
          },
          {
            "namestring": "Urogale",
            "identifiers": {
              "namebankID": 2481844
            },
            "pages": [
              2853545,
              2853561
            ]
          },
          {
            "namestring": "Limnomys",
            "identifiers": {
              "namebankID": 2481054
            },
            "pages": [
              2853545,
              2853561,
              2853565
            ]
          },
          {
            "namestring": "Apomys",
            "identifiers": {
              "namebankID": 2480863
            },
            "pages": [
              2853545,
              2853556,
              2853562,
              2853564,
              2853565
            ]
          },
          {
            "namestring": "Crunomys",
            "identifiers": {
              "namebankID": 2480946
            },
            "pages": [
              2853545,
              2853562,
              2853565
            ]
          },
          {
            "namestring": "Batomys",
            "identifiers": {
              "namebankID": 2480884
            },
            "pages": [
              2853545,
              2853561,
              2853562,
              2853565
            ]
          },
          {
            "namestring": "Suncus murinus",
            "identifiers": {
              "namebankID": 2479638
            },
            "pages": [
              2853545,
              2853547,
              2853548,
              2853562
            ]
          },
          {
            "namestring": "Crocidura",
            "identifiers": {
              "namebankID": 2479448
            },
            "pages": [
              2853545,
              2853562
            ]
          },
          {
            "namestring": "Cynocephalus",
            "identifiers": {
              "namebankID": 2481851
            },
            "pages": [
              2853545,
              2853562
            ]
          },
          {
            "namestring": "Paradoxurus hermaphroditus",
            "identifiers": {
              "namebankID": 2478460
            },
            "pages": [
              2853546,
              2853559
            ]
          },
          {
            "namestring": "None",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853547,
              2853557
            ]
          },
          {
            "namestring": "Crocidura beatus",
            "identifiers": {
              "namebankID": 2479459
            },
            "pages": [
              2853547
            ]
          },
          {
            "namestring": "Soricidae",
            "identifiers": {
              "namebankID": 2479444
            },
            "pages": [
              2853547
            ]
          },
          {
            "namestring": "Suncus murium",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853547,
              2853561
            ]
          },
          {
            "namestring": "Insectivora",
            "identifiers": {
              "namebankID": 2479346
            },
            "pages": [
              2853547,
              2853548
            ]
          },
          {
            "namestring": "Chiroptera",
            "identifiers": {
              "namebankID": 2476934
            },
            "pages": [
              2853548,
              2853564,
              2853565
            ]
          },
          {
            "namestring": "Pteropodidae",
            "identifiers": {
              "namebankID": 2477081
            },
            "pages": [
              2853548,
              2853551,
              2853563,
              2853564,
              2853565
            ]
          },
          {
            "namestring": "Rodentia",
            "identifiers": {
              "namebankID": 2476907
            },
            "pages": [
              2853548,
              2853556,
              2853564,
              2853565
            ]
          },
          {
            "namestring": "Cynopterus brachyotis",
            "identifiers": {
              "namebankID": 2477105
            },
            "pages": [
              2853548
            ]
          },
          {
            "namestring": "Freycinetia",
            "identifiers": {
              "namebankID": 2665156
            },
            "pages": [
              2853549,
              2853550
            ]
          },
          {
            "namestring": "Harpyionycteris whiteheadi",
            "identifiers": {
              "namebankID": 2477141
            },
            "pages": [
              2853549
            ]
          },
          {
            "namestring": "Macroglossus minimus",
            "identifiers": {
              "namebankID": 2477273
            },
            "pages": [
              2853550
            ]
          },
          {
            "namestring": "Musa minimus",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853550
            ]
          },
          {
            "namestring": "Pteropus",
            "identifiers": {
              "namebankID": 2477193
            },
            "pages": [
              2853553,
              2853564
            ]
          },
          {
            "namestring": "Pteropus hypomelanus",
            "identifiers": {
              "namebankID": 2477209
            },
            "pages": [
              2853553,
              2853554
            ]
          },
          {
            "namestring": "Haplonycteris fischeri",
            "identifiers": {
              "namebankID": 2477138
            },
            "pages": [
              2853553,
              2853560,
              2853562,
              2853564
            ]
          },
          {
            "namestring": "Ptenochirus jagori",
            "identifiers": {
              "namebankID": 2477187
            },
            "pages": [
              2853553,
              2853564
            ]
          },
          {
            "namestring": "Otopteropus",
            "identifiers": {
              "namebankID": 2477178
            },
            "pages": [
              2853553
            ]
          },
          {
            "namestring": "Pteropus pumilus",
            "identifiers": {
              "namebankID": 2477233
            },
            "pages": [
              2853554
            ]
          },
          {
            "namestring": "Emballonuridae",
            "identifiers": {
              "namebankID": 2477292
            },
            "pages": [
              2853554
            ]
          },
          {
            "namestring": "Rhinolophus arcuatus",
            "identifiers": {
              "namebankID": 2476943
            },
            "pages": [
              2853554
            ]
          },
          {
            "namestring": "Rhinolophidae",
            "identifiers": {
              "namebankID": 2476935
            },
            "pages": [
              2853554
            ]
          },
          {
            "namestring": "Rhinolophus subrufus",
            "identifiers": {
              "namebankID": 2476996
            },
            "pages": [
              2853554
            ]
          },
          {
            "namestring": "Rhinolophus",
            "identifiers": {
              "namebankID": 2476937
            },
            "pages": [
              2853554
            ]
          },
          {
            "namestring": "Rhinolophus arcua",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853554
            ]
          },
          {
            "namestring": "Rhinolophus inops",
            "identifiers": {
              "namebankID": 2476966
            },
            "pages": [
              2853554
            ]
          },
          {
            "namestring": "Vespertilionidae",
            "identifiers": {
              "namebankID": 2477611
            },
            "pages": [
              2853555
            ]
          },
          {
            "namestring": "Rhinolophus virgo",
            "identifiers": {
              "namebankID": 2477000
            },
            "pages": [
              2853555
            ]
          },
          {
            "namestring": "Pipistrellus javanicus",
            "identifiers": {
              "namebankID": 2477865
            },
            "pages": [
              2853555
            ]
          },
          {
            "namestring": "Murina cyclotis",
            "identifiers": {
              "namebankID": 2477938
            },
            "pages": [
              2853555
            ]
          },
          {
            "namestring": "Bullimus bagobus",
            "identifiers": {
              "namebankID": 2480894
            },
            "pages": [
              2853556
            ]
          },
          {
            "namestring": "Apomys hylocoetes",
            "identifiers": {
              "namebankID": 2480866
            },
            "pages": [
              2853556
            ]
          },
          {
            "namestring": "Apomys insignis",
            "identifiers": {
              "namebankID": 2480867
            },
            "pages": [
              2853556
            ]
          },
          {
            "namestring": "Macaca fascicularis",
            "identifiers": {
              "namebankID": 2481656
            },
            "pages": [
              2853556,
              2853563
            ]
          },
          {
            "namestring": "Apomys camiguinensis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853556
            ]
          },
          {
            "namestring": "Bullimus gamay",
            "identifiers": {
              "namebankID": 5589461
            },
            "pages": [
              2853556
            ]
          },
          {
            "namestring": "Cercopithecidae",
            "identifiers": {
              "namebankID": 2481623
            },
            "pages": [
              2853556
            ]
          },
          {
            "namestring": "Muridae",
            "identifiers": {
              "namebankID": 2480343
            },
            "pages": [
              2853556,
              2853564,
              2853565
            ]
          },
          {
            "namestring": "Crunomys melanius",
            "identifiers": {
              "namebankID": 2480949
            },
            "pages": [
              2853557
            ]
          },
          {
            "namestring": "Rattus everetti",
            "identifiers": {
              "namebankID": 2481318
            },
            "pages": [
              2853557,
              2853562
            ]
          },
          {
            "namestring": "Rattus",
            "identifiers": {
              "namebankID": 2481308
            },
            "pages": [
              2853559
            ]
          },
          {
            "namestring": "Rattus rattus",
            "identifiers": {
              "namebankID": 2481350
            },
            "pages": [
              2853559
            ]
          },
          {
            "namestring": "Viverridae",
            "identifiers": {
              "namebankID": 2478429
            },
            "pages": [
              2853559
            ]
          },
          {
            "namestring": "Carnivora",
            "identifiers": {
              "namebankID": 2478066
            },
            "pages": [
              2853559
            ]
          },
          {
            "namestring": "Rattus mindanensis",
            "identifiers": {
              "namebankID": 6916331
            },
            "pages": [
              2853559
            ]
          },
          {
            "namestring": "Acerodon jubatus",
            "identifiers": {
              "namebankID": 2477086
            },
            "pages": [
              2853560
            ]
          },
          {
            "namestring": "Artiodactyla",
            "identifiers": {
              "namebankID": 2478648
            },
            "pages": [
              2853560
            ]
          },
          {
            "namestring": "Megaerops ecaudatus",
            "identifiers": {
              "namebankID": 2477147
            },
            "pages": [
              2853560
            ]
          },
          {
            "namestring": "Suidae",
            "identifiers": {
              "namebankID": 2478649
            },
            "pages": [
              2853560
            ]
          },
          {
            "namestring": "Viverra tangalunga",
            "identifiers": {
              "namebankID": 2478484
            },
            "pages": [
              2853560
            ]
          },
          {
            "namestring": "Ptenochirus minor",
            "identifiers": {
              "namebankID": 2477188
            },
            "pages": [
              2853560,
              2853562
            ]
          },
          {
            "namestring": "Alionycteris paucidentata",
            "identifiers": {
              "namebankID": 2477093
            },
            "pages": [
              2853560,
              2853562
            ]
          },
          {
            "namestring": "Eonycteris spelaea",
            "identifiers": {
              "namebankID": 2477272
            },
            "pages": [
              2853560
            ]
          },
          {
            "namestring": "Sus philippensis",
            "identifiers": {
              "namebankID": 2478940
            },
            "pages": [
              2853560
            ]
          },
          {
            "namestring": "Rousettus amplexicaudatus",
            "identifiers": {
              "namebankID": 2477253
            },
            "pages": [
              2853560
            ]
          },
          {
            "namestring": "Pteropus vampyrus",
            "identifiers": {
              "namebankID": 2477247
            },
            "pages": [
              2853560
            ]
          },
          {
            "namestring": "Tarsomys echinatus",
            "identifiers": {
              "namebankID": 2481404
            },
            "pages": [
              2853562
            ]
          },
          {
            "namestring": "Limnomys sibuanus",
            "identifiers": {
              "namebankID": 2481055
            },
            "pages": [
              2853562
            ]
          },
          {
            "namestring": "Rousettus",
            "identifiers": {
              "namebankID": 2477251
            },
            "pages": [
              2853562
            ]
          },
          {
            "namestring": "Limnomys bryophilus",
            "identifiers": {
              "namebankID": 5507396
            },
            "pages": [
              2853562
            ]
          },
          {
            "namestring": "Viverra",
            "identifiers": {
              "namebankID": 2478481
            },
            "pages": [
              2853562
            ]
          },
          {
            "namestring": "Eonycteris",
            "identifiers": {
              "namebankID": 2477270
            },
            "pages": [
              2853562
            ]
          },
          {
            "namestring": "Tarsomys apoensis",
            "identifiers": {
              "namebankID": 2481403
            },
            "pages": [
              2853562
            ]
          },
          {
            "namestring": "Suncus minimis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853563
            ]
          },
          {
            "namestring": "Oryx",
            "identifiers": {
              "namebankID": 2478924
            },
            "pages": [
              2853563
            ]
          },
          {
            "namestring": "Mammalia",
            "identifiers": {
              "namebankID": 2478620
            },
            "pages": [
              2853564,
              2853565
            ]
          },
          {
            "namestring": "Megachiroptera",
            "identifiers": {
              "namebankID": 2721449
            },
            "pages": [
              2853564
            ]
          },
          {
            "namestring": "Murinae",
            "identifiers": {
              "namebankID": 2480810
            },
            "pages": [
              2853565
            ]
          },
          {
            "namestring": "Archboldomys",
            "identifiers": {
              "namebankID": 2480872
            },
            "pages": [
              2853565
            ]
          },
          {
            "namestring": "Harpyionycteris",
            "identifiers": {
              "namebankID": 2477139
            },
            "pages": [
              2853565
            ]
          },
          {
            "namestring": "Otopteropus cartilagonodus",
            "identifiers": {
              "namebankID": 2477179
            },
            "pages": [
              2853565
            ]
          }
        ]
      },
      "biostor\/65896": {
        "_id": "biostor\/65896",
        "_rev": "1-85e09d1a9abb943b3e30608cbc12c875",
        "author": [
          {
            "firstname": "L R",
            "lastname": "Heaney",
            "name": "L R Heaney"
          },
          {
            "firstname": "Tabaranza",
            "lastname": "Jr",
            "name": "Tabaranza Jr"
          },
          {
            "name": "B"
          },
          {
            "firstname": "E A",
            "lastname": "Rickart",
            "name": "E A Rickart"
          },
          {
            "firstname": "D S",
            "lastname": "Balete",
            "name": "D S Balete"
          },
          {
            "firstname": "N R",
            "lastname": "Ingle",
            "name": "N R Ingle"
          }
        ],
        "type": "article",
        "title": "The Mammals of Mt. Kitanglad Nature Park, Mindanao, Philippines",
        "journal": {
          "name": "Fieldiana: Zoology",
          "volume": "112",
          "pages": "1--63",
          "identifier": [
            {
              "type": "issn",
              "id": "0015-0754"
            }
          ]
        },
        "year": "2006",
        "link": [
          {
            "anchor": "LINK",
            "url": "http:\/\/biostor.org\/reference\/65896"
          },
          {
            "anchor": "LINK",
            "url": "http:\/\/www.biodiversitylibrary.org\/page\/2849316"
          }
        ],
        "identifier": [
          {
            "type": "biostor",
            "id": 65896
          },
          {
            "type": "bhl",
            "id": 2849316
          },
          {
            "type": "doi",
            "id": "10.3158\/0015-0754(2006)186[1:TMOMKN]2.0.CO;2"
          }
        ],
        "provenance": {
          "biostor": {
            "time": "2013-03-11T17:25:07+0000",
            "url": "http:\/\/biostor.org\/reference\/65896.json"
          }
        },
        "citation": "L R Heaney, Tabaranza Jr, B, E A Rickart, D S Balete, N R Ingle (2006) The Mammals of Mt. Kitanglad Nature Park, Mindanao, Philippines. Fieldiana: Zoology, 112: 1--63",
        "thumbnail": "data:image\/gif;base64,R0lGODlhZACRAPYAADw+REJDR0RGSkZITkhJTkpMUk9RVlJTV1RVXFdZXVhaX1dZYFtcYl9gZWFi\r\nZ2Nla2Zobmlpb2ZpcWttc25veG9xdm9yeXBwd3N0e3d5fnh6f3V3gHd5gnt9hHx\/iYB\/iH6Ahn6B\r\niYCBhoOFjIaIj4mKj4WHkYeJkYuNlI2PmJCPlY6Qlo6RmZGSl5OVnJiXnpaYnpmZnpaWoJaZoZuc\r\no52fqKCfpZ6gpp+hqaGipqOlq6aorqmqrqansKepsKutsq+vuK6wta6xuLGytrO1ura4vbm6vre5\r\nwLu9wsC\/w7\/Bxb\/CyMHCxsPFysjHzMbIzcrLztDPz8\/Qz9DQz8fK0MzO0czP2NDP0c\/Q087R2dLT\r\n1NjX1dfY1tnZ1tTW2djX2NfY2dvb2uDf3N\/g3eHh3tbZ4drc4eTl4ejn4uno4gAAAAAAAAAAAAAA\r\nAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5\r\nBAAAAAAALAAAAABkAJEAAAf+gGFkY11hhlxbWlpXjIqLWlFQU4pTV1haUFBRjFdQVZJRkJChVYqN\r\njo5XpqeqqF9aW69fX1uxs19huGFihoa8XWJiXYVhY4ZdXMmLVVWdj41Xm5uKm52Ro5iKnpWnj1pc\r\nXquPXt2oWq\/n6bW2Yltit7+7X8FhxIXJXKbLjJulWs2tPkH5NzCUJ04AOamC0kpLOGicwplTJBHW\r\nlnDrvNjKpatePV676g1DlqziIk6OGHo7FcVgtWgD+akCiIpROHIOVeksp+hiIlgU193q2MuXoS1j\r\n8OVzNMWTFClYGCWkuZDhwn9YoErBhHKnqocVs3RdRc4LOlgYLa7bAkbXFkP+X4gJm5IPnLlSWKpA\r\nvVJK6j9oippBwbIpa1avpZpRbGWTkVhyjE+aVPRKYzgwbTfiouXR0JRE+bJKGYgp01O+UvlqEdst\r\nk5anT7EQbsYM5clVjRXqPNmwlcSfXoJjnhWGba6PhaZMev3tWyQoXrhg4ZLQUTMwXBh5CiMlehbp\r\nT82ptvnFZrgwuhNeMYue8iKTwLW0Ja75bRflWujyAAEjBpenO6yAxAheUCGbFbJhYUYOSHhRhRVX\r\ntLAEDjsIAcMTT3Cxww1C6KDEVg594YQNmAFBhBMoNIGEFk5Q4QVrWTRBgw1XfOEFEElAmEUUtFGl\r\niF3ydbSFFPhJoUQCOQj+AAIISAwxQAYOtAACBg+AUMEEK3hAJQ1OiHDCA0vckIAFDmSwhBQlCFAE\r\nBg24AIIGH6jwwQQnoNAADVdA8MAOH2DQAQkcmIACjg9ggAILKWzwQRZONJpJE1BQQcUnk3rSTC20\r\nDBMebBME8QAEFixhxApTQsCABAhA4EADEyCQQQQcXHEBBxhIIUQIGFQAQgxSwBBABldWgEADDTyg\r\nwQUIMICADiqO8AEBGHCwwAIlOIBEEhOYYQEDH8iwgA1EOGgFbWOhwhYtW3QBmxRcFEEEEjsUsYQW\r\nRyjBxRJNNPGEvkg0McQPRfRLBBFGOCHFEkoowUTCUCBhhBD11rtEEiX+2OCEEUz0m0QTVyRxRBJI\r\nIHGEivkiQcXHSaTcQxFZJAGFo1W0SEWkk16aGS2waTHGDQ640OYNQyxJRBA6FCHEw1qYgcKnIOyw\r\nAQYz7OCDDy7AUOEPPyyxxBNLZKF1FlBACCEzB9VsaSedMEObFWwzU3MVZvP1ILmJrJXzvaBCgAED\r\nCQxQgQHKVnAABg7oAAYIHfxQQAIRODBBAdMesAACB2hgwA5aZ651E0xA6oSlTTCTb6Okz\/wgFS02\r\nSkUSLW7cRItuA0TbN4iss66RShQRRBA8BHGDD7\/zsAMN\/7IAxQ9CNAEDDTTgcMIFIWiwIQ0wBIGD\r\nEAdrjkW+3Osracz+Trw+Our5UpHvxqsnsXr4TbhePhVPZOKEP2BYtO5\/Z9ZFu3DBgQO\/pE8Yl6SW\r\ngATNZY9rStDc5rrHvZh9InzmixT7uGc+9UmKdQzs3r5eNxBEKOMpy2HR6NgXvhZByHySMl++MpdA\r\nBbpQgVyjAgxXuDUMVdB8MkMhyWi4OXw1wYfca04XYCGJSYSBCEWQ28xqRoUrHGEGSLBCD2pwBLal\r\nEENKYAEOlmAFrbEga0VwAcKIkLkBPgELW8OBEp4AvxskcGROGBkVgKADIlBhCE2wggq5B8TuobAn\r\nQAmPFsSAAhqggAMW6AAHOPAAD3hABz0AQA6ssC0LmMACE7BkCET+NoAFbGACIFhCADawhCBsYAUW\r\nsMAGNnCCDEhgSRY4whIq0AAhIAwCMtgABWZABQnUIAsnQIAHTkAnE5xgAz6QIQ1\/yMAnOKJuINJC\r\nF4wABBnYgAc\/6AENZFADcE2oB0vwgQ5mQAMTyIAFNJhBD56IgxSEwI0suEERlOCDGbwzBFYLQZ3c\r\nJE90\/oAFRYDBDJzXgyTUgAVI6IEJXNACF5zgAylop8nwZb6tZXAi4eFCGJCQAyeAIQtHAMKLgNCg\r\nJ1ohZFZoQhZelAUZ\/uAIalRCS6sghBtobYtekxcX4fcEry0hhWXkYvlSOikDCVBS3cMX1\/YFRCf0\r\n5CeSUMQZWnD+gQhgQAIRgNUROLAoGgxglRTYgARCsAQhSGACEpDAEhogAbZOwAcgUNMSLCCBVUIg\r\nBFx74QsLyLk+ZpCZfPRrvhqSCOUkQwxEsIENVCCDF9iABh5b5xFk4AIZzKAGM3DB9ULgAhTUAGE3\r\nYAELQPADH6xgizhwgQU0wIIZ6FWBCWxh54C4wQy6cIfca8hnQMSFL5jBDGH4bXDNEBwzlKEMvz2u\r\ncldq3DJkgW1lCI5zV+q1LDh3CWUAAxayQF0qSKGlVOAuFlJohedyd6UszcJ2X8TS9bI0HFZYTSN+\r\nMoWtgMMMJUiAAxhALP7yl1gNUEADFsBfARNrAcRSAAMWzDf+Big4AQpIgIQdzGAHN8DBAq6wgisM\r\n4GI94MMQgIAERHzWs06gAihOMYon0IJ8hNC+GmUCD4YABCBg7QdB+AEQcjy1qe1AajiYGg6GTOQb\r\n3KDIRk6ykpccgxvQwMjpfLKTmUdlzDKPnDDIMgxawOUWiHYFYEZBmHVAicJuBRlgCEN0gnMT4XA3\r\nveelrnrNW94sSIEZepTUeL0rKSlQQY\/jzUqf9VyzvIxLvOqVTZwTNOc5y0YLMyvzcnpBnSbCTW1u\r\nG68Nebo1rTH1tfgKNcKA6MKEJWzUPhRsUjMX2FAzoXOoiMJyjOOFcV1hXD1CUKZT+D+eYqjTmcsr\r\nq7emhFb+r\/AJLYwtRUWNwp9ybdV5ZSC+ojmJKNTOEGP7B561UF4s5BmAvP5fDWUIvxr+cKnmTuq5\r\nzW3RUPM6X2y04b725WvBXmISypkEZooDkLbZxm1+5rW8MZTXX5N6manuYWyRfeqg\/tSiNIz2Dz3N\r\nzAWaYxMaNQQY4nuSB9WaHHrUY8DDPcBx\/1Rfnk45sG37bITRu3xNMJ8NvUdwH\/663N0DkXJCAYte\r\n6Povqqm12nidiSXOm4LoBnbJ+7jAibcw2CnHELzhLdjado\/nO5\/EW4CrhUsowgq15ra2v7dEmsl8\r\n6lRHebsPHlgmpFrYv565DmGO9r9yLNYW6YXXwx6RWsv+DW5LrBQUCA6\/mK993g\/\/YeeY6XbuIVtz\r\nS7254WO+x7p3r3OhwLespXmIRwOdbQ\/B9fciFT8A6ktftV15yiuecKcjENiRl6GqM\/jq7jFFFOna\r\nBXBUkQWx6yQvQyc6zWI+b6mfXu37WnzF4c3UNXqa4PGON+XtbvV85WcKm\/8MMIoDIshc4TEhl1Sk\r\nLk16KBCfjbaFeqgnzn7NIV\/9E+9j5e3ehBDmBxbDqIcjXvT9\/sd3vEMHNzQDfejHRoUndc\/XTBkk\r\nbDXUaagXfee2QbU1QewzEJrHeYKwBaShEOSwUrLhNin0CWxkfjx1fK1mcMXWQnzER0nXaQW3VN4j\r\nc7P+F0T4gXtFMRDkQBre8CC35gngdkXRV27ox3o\/lAVspGm0lWrrRnVDmFQwiHrq1gSogH25JwZk\r\nMERYAHJ\/AXbAR3YGsmcESG6Ex0dSsAMZAAK4QgIhgAIusEcQF23oZnwUJHMSCHEMRCSjsAVTQAz1\r\nUAXeZgVnIzZtk0IDGH3Qp3KitgQ\/cAInEAJraAEngAPKxHQbtEbPFnOnl3gFWHDKB2uQsAWh8BYh\r\nEQZd9whqc2vqhWnMEHB7pmnxVkNHd2699mdCuILIV3B2eHLS5oD5onxbEQqhKAhdQAZhoDb\/wG2l\r\n8CIJsl2BdoQCx1PkJnuQ53BqR3XklohnojUyFHn+MSRsx6d8FkgJ0jSMhuB1t0YErBMyWCB1uJg7\r\nsiSNR4BstsRCnnYE84g1I4M8ZLQETGBLR4AEW8RCSmBTIvMESMA191gv5UYETzAyQQQU+ZEuZDCR\r\nxWgKXiADPyADKFA08YQDmeVaKDADiJICE8ICKCAEP+CIIZACMhCJQnACRIADIHACS+CIkhgCIilm\r\nK2BMMoAEIWCSLqBFR3ACouVaKeADSFAnSrBQoiVaddIC3ONUVBiKwAASihE6jPA54fV88RhAS1dG\r\nMgQxLCSNDRcyWyNLCQQx\/6g1CVMER\/CWp\/ZGEVMEDSlLSFAEPjAwRtA9Oqgc6TKMczEFXlACNLD+\r\nAzaAkVdgAziyATqAAgqlRSwQTiEwZDegWQE5ZDLgATXQAzMgkjUQAkfQAx6QAp3ZmTVARUtgAqcp\r\nRkTAAj9pjzWgBEIgA47YA1TQAy7QAzjQA00ASep0iX5JCcMgDO2gHFdQBDbGAyqABFWAI7cJBD0Q\r\nnT6QTWwJMULgA0MmSz4gBNCZTT3gA0fgA5+VUFM0RTiwmUAQTtm0RUpgj7YEkAhjnbYUnbrJArfp\r\nAz3wA70ohVM4DBNpDJNwBdeSBERwBETQBG+JBOHzjyITMm9pjwgTMeCpNQ8KBA9aQFT0lmUlWSEF\r\nMSLzjzjwoC9lj6H5lkJQoD+ABEQgBEIgMu3+mXNPpX3DSAZcMBBVoFiVZQMukE42MAM+UE1HkAJa\r\n5JEH9UU3cChCuoafGQIyYAIeoJJBegIyIAM4sJKIwgInAAQ42Zk9sIZYuoYnkAJCgKU9gCgmkAIK\r\n5QJC6gImEAPdQxdRoIf4VxSKJqANAwSMMC4pxTZNwJBXdI2Z86BL8I86RAUfelsq1C8xJ5sJJI0n\r\nY6jOtjmK2j7KxD1MACJ6+Jf0EAaXkJgtkJgmcJthiln26QP2SQOihQJIGgI9YAX\/VFY\/eSg1gAQm\r\nYExIIKQncAQ1QJpTmgKHMqVUIAQm0AEoEAIs+pMmwAIeEJkjiQQ5uYbF6gKc44mUEAWFABL+1BEV\r\nKVMbXtAE6blCVZAvXjCoBvqPsiRL2kiuDJoEJnKuGqquH\/qWLzWoLDqP9eqhTcCiQEAFQ8aiIeWW\r\nvcgEz5Qf2yeMpRAFuMkDNtADigUEMCADU1MFS9A8P5AFSMAC4qmbgxqS9XSeAxWiVuADNvBZMLWZ\r\nS1ADkXiaKjIDKoCdunkD6oQD+\/IDQ9YEOCADQLCZIWNN0vmmiPBMM0oGr\/EJAzMw0MkDROADOaBj\r\njVJjQICgPYY8g4qfpVUDu3lkdsQDmEVAurkDTcCZ0TmrIUUEIjlFNFADliVLHkkDZYUDI2sCPpAE\r\nLLlNHdU+ThCny2GtwNAFhOAIA6ME13L+PhbqrSQlrn16BFhQoLIZsuaaBVmEA0hgoe8iBLv5oPlS\r\noOukIgwKU0MQuebjnlCAlAlaYyiFlIHLPTwXkSNRCHUzBTbwLzTwAjEQAylQNQ\/rApWlA+YHSVrg\r\nAzSwAjdgBThQSBfyAy3gkTPQkpSlpiewo97akiF5BTuAuzOQAimgAp7lBTaQApEIBShwvIiiAg1V\r\nA1fgAoQpA59zDUChHCMxkcPwFheTBFcQCzziBU7QCR+lCggSHF4HN92BBUzwgWi0BHwROubXNU6Q\r\nMillMj3iD1BAoIOFIbKUL3CTwPMTOmSTCS8zELWAb8MZDMBABluQAyUQAy2gAiasoyX+cMLcRARc\r\n0AIwEAI+sAQt8LssAAM0OQMtUEhIIAMPiwIpAAOiJQItcAIkcKYyUARJgLs00ASq6qsekCIkcAIp\r\nSgNRXFk00FkqELv+Qpg78Dl32wo\/sbpX+L53ywROgMZR4DHs2ijt4wVPwARGMBD5ogQHigODYaCQ\r\nsjFJQGNH4HYhQwRDUK5I0DBGcAROULQiEzrsmjKBrK5DYAQqWjBMkDIvc7f3d30jAcLrQAQ\/NgRD\r\nMGP3ywMrg5w8kANAwARVQGM0AAU4QAQ8YDTCEwM0MDW1nJdO1AJDoAM+cAWgnLQ6YJgv4wI\/IMin\r\nnANEgKdOkAM7cAU8oANDQARXYAT+Q7ADB8oDJsIP9se+e1uc93EDO5ADiqUDNlAEcVQENvAD4jy9\r\nnVMD4VwFu4MDwrOjN5ACNJADWTwDPxCuMbADy6MFNTACtIzPSZwEPPACO6ACO\/ACMLCjhSw1TTA8\r\nMGAxjuUCBzq7XvsyqSucw9kLYCAGoUwEUZDA8tsEYHC\/V4AeTmC\/V9AEKeoJn7OXjQIGGswidxsE\r\neFrJVYAEXEA68rvBhcwxSVAw4UOgV6DK\/pIEXvADrHMFnyO\/SKAdqfsZeusLdRMFPNACL\/ACORAD\r\nLzAjibywR6BYj4W0zEzOp6zFO5AEhiQDQ4ACI\/ADNKACKsBQLSADRJADJkACQGD+A2wIBCSAAjBA\r\nBC6QAzCA0DBAAiSwnD7QAS9wBSSAuyigAiRQAicQA53gGusrTcTZDt8wBUnQEhysBdKsE1lQP5mB\r\nCY7CCPnADNciN+FTyDba0iHjxpngMk2dBEFwMZ7TCeHDBKgTM0kQrheTyBtTMJmQeaG4h+4wisBg\r\nA7I7u+CiAjpazihsBDwgAzqQBC8wBJ3lyQjdAkCQxfjsWETwApS11XM9BOrNPESAszYwAgrLAUwc\r\nA42F0E6gAzmQA19NAsyDBC7w1Z6MJ5mHb3lYlcLwDV0QBZWcMmG8l3kEMg\/cPrUhMuGjxAoaMiHj\r\nMQj6LpVsBAUztneZBEqMoHD+dC3hXKBAoMRH4C5FWwTIrNs\/EL8vAykN8YkgfIVcMAxDkANozNQD\r\n4wVDkARLi6cmMjChXAVZjARmcGNJEAYii81D4ARFUMxYk0Qj87oHSuR19APUbLQqEskqispI7pZO\r\nAMpeC81GEA1V0BKwEKe10Nn50RI\/8AJMfc87oANV0AM8UNg2YNCKNTyQpU0\/cAU\/UDWFXgTD06Ns\r\nvaNkbdBEoAMqUFDifJjWxAM0oAM1YASGvaM6YE2NBd2orFgMsjxfHD4q4eZxOhIikS6f8TnnwAnl\r\nkTqK4QleAAaTsgi\/rQjiY36vc78AAQXSPD8ecyL3a9OZ3etJ1C8P5FSNsub+VO7UGqzZhbXqezsS\r\nWxAD4rvQS2wCL+ACSaCYOmpZpo4EO1zRjFVjI0ACP4DpKmACd00CMkADhL1NKsCIqgoDOnAEI3AC\r\nQ9ACIwADKjACAK+wzUvXJiDXJUACdXQCNiACMLDBFihroJguxKmHynG3L7MF0bAIVsEJKs0QnMMx\r\njBBzMaPEVxBBO+0EW3C35JAvRcAx7JMyMR+u3RO4UABHUVkFG+MFl4zqyX1\/2Le677vgMQDdNhAF\r\nRw8EfR6dNsDzTw8DKJC0KRDOVJbFUFACLpDnNMADF4m7hxkD1By7MPzf450E8\/4CkXsCOdACM7C9\r\nBkpZKZLFOuBYYa+7Gmz+4BT\/wdjXEkZAzkYQBQTjrQRjoA88BFXABEztrb\/8Y0Swz4c8BCJbyGwd\r\nzUEw5Ejwo+EMnU3gLlAABDmgA0aQtFPTAzrAAyDT7jqg+On8Az+2AzHgAjXeBFinCJvc6mLQxymD\r\njimDWHfZMZFb4isy+g8cMvmyA5277EiUA3u5lwb6LjqQwETABAQjMp2bzBsTzQCDlyoaR+8SzX0a\r\nBKQd2kEPSHo7nMGJ6Qrb9QwbR2\/vBEz\/A5+eAz7QBD5+BJmelz8A3ZkOBeR0z4CA9GOTMwOj0wJz\r\n5CNDQ9Mo00JE9MjTY+My5PPyCMTzYkOjQtPighTDA9XUBKU1NRUF2yX+FlbbtaXlpXvFm2QWlvT1\r\nFWZWVYRURHVFpVulCpbUxAtddYR0BcVUFeVkBFVFpIU05MTaVO4EBZVe7gV+3pRU1TTPk6TqvU6k\r\nrj6l5aolVpcutrZ0ueICig0VLT5A+eHiCo0UV5LQ2IHiBw8STYiMONHCiQsUKHIkOXFCBYqRNJyc\r\niHHCpAgYMD7maIKCRAuVJH8QEZEkxwhOKGTIUMEqg4ohQ1TAiIGixZUoUl4FDBhl4EAyr6ZwYZIN\r\nrBQpVapcKZtLnZayVL59o6KFCj1sq5g8mbfEixYovNTlS7eKFZNVTubRW4XEWpJ7VfayUiWtCVhV\r\nrfx13bJFzEDMBm\/+oOBBIwePGD9+aKGhw0eMHDps7PORw9GMHaEcDYGCAgmlHIVyoGpCI0YMTqFp\r\nNPFBAwYUHTmu5CgZqsoQjCOIvBjS5CVzGjZsxEgypSoUf\/8Cau3C9ZUUHjyYth9SZIgWID98AJmk\r\nA0mTH0J27PCxQ31D6FAEFDfo9wN8PfSgQxJRBLEDD\/QB6AMTQzgCBRBAOJGDDz70sIMTSQzhyRI9\r\nEJGEDjoY4WGEOgShymCuWBaFQedxlgQTTBhxTxJw5WihEzo2ocURTWDBhRE\/xLADFEZwgUQSWvCA\r\nAw0\/NGEEEluIaAQR3dSFTxFE+GCEEceAwxsMQCSRzBGq0IAEFUz+IKHbFUoYMRYUUvyzRSw1ntfF\r\nFFtA8UIL3gkHQ4W1zaDDDC7swMQNM\/jgBRA7vLCDESw0sUMNTOyQwyFCoBCDEzzk4EJ\/JySngg9I\r\nyEASqynIUASrKOxAQ24z\/FDECSQc0cIJRyHhgg7rsOJPLAHZqNUWr3Q5yRTqbDEiFGDopYUVTEDp\r\njBHzgAHFPt46YwUWUDxRxCrqRMEPFFhUoV+GQg5WxWDlmOWMXE08Adk83tCDBFjpqBXQK1kx6+wU\r\nXfyAwgslWFeqER3kgMSpLSQXbA5GgESDESjQMIROHyPRQrAskBIDDEak3AIKXZKAhAonDIFCCjXI\r\ncIILLqQAxBH+KbhAyQkk6exCTESgQIQNJeTQritROH2eGAmv2085UFhRhRNWSJNNOU20JRlgrQRG\r\nZF1MGImNFjsioYQSTSABxRBuJqFflHTT6QQRRu64g9xNxGfE228bwYQThjtBnmVa0RIGZwOy154T\r\nAfKwYoo8hMRDfES4wMMNEcIwmhEq5uAfESSj0h4qNzCnMeU73ACbkqSzxhsNi7xOhApM+kfID7z1\r\nvVdVM\/6TlVZhaCHFeEREyB45QHQ0hBHTASFEE5kH0cQQQQgBEQ0AMlEaD0QwZSFT+wzhuUYu8HcE\r\nESquIH2VKupg5fKkj3lDCjQAUQQPJCE3A8iMx2lTuMJANFP+Cy5wQQtE2NEQuiAkw2lhcGp5QuCC\r\nEAQl5MgLksnGEJawhMDNaRJH0JERomCEEkJhB0UokwWJkCX9EGEJTCgCFtrXkX0QQQm8WZNPGgi3\r\nb0grcVEoXi3EUJ4poGo4TPDOrZDwEkeowH0r0MEKVsACF7TgCEqYwQ1KwQISiIAIORBaCgyRKyLw\r\nQGhEMNkMNgYDjsXxQizw2EouBiwmwAoGKiABCVQiiXZ1xWAHJAgXLAOFQakjCbjwgjq4oIsnSIEV\r\nevGCE5SghSVggRVrOQIWkDdBxCxwL85YgrvcxIQlEEkVZ1FHE45ABbCJjR76mgc\/HtOPf8DiTwjs\r\nghZuEQP+FbxAdyXQ3QpPcAMv7AAGnonBDUS0gjuhQDk7KJkI4JarEzQhCB2IAQ2gEAPTkQAFT5hB\r\nVERQsiEwgRQeaF8HSgGFFkSPFCSpJ5tIIIMqSotdM9qljWiBPCigcAiL0RETeFAv03GwbW4jAjOU\r\n4AUqLAEJWIChjjyZpX3sqExacIJ+2qcjGLaPCPSYzm1eKTcqkBSlSDCThVYxBIseDnG6lAV6CHIL\r\nzFAupj8IQkybxITPkEYIOljPDSDnnx3ogAhc0AjkdHCI\/fBAdJTTwQ9uAB8qeS4IoDGCRESjEf+0\r\n9DP78YR\/eHApKPAgCK4YT1eKWLybBkpaRNBIgtrDAx\/+PKEjPojp8rbJA\/4sTwhr3cESgrA69uiA\r\nqOBTQtzCp4MDLW8HPaAPEBZrPRf5RwdAQAINZoAE\/9xgtJHVmH9uGZ6CFU8zm\/FlmboQU7A0Bjtz\r\nogEWnrBJR962I0GQghOewIMlSGEJe11FEYrAhCmAJXDl6BJymTAJHxQoXNLTIZBWUS+vNVCEQvIS\r\nP8rjJ0AFagtYQMQQPhEqUiSiY9OcAUqOsAL2uGAFSl0BEWDAAiG44CkrgAEKVtACjyWHCCwoGQl+\r\nAIMUlKxkN2ijEWoCmpq1TE0tmAENWABgmqxACEySllpgYTAbkWEMmCngKAu3Fy\/AsAkR\/QcHqYCF\r\nGGv+4V0x1pMUbkuFJ+i4CubS0z\/OpY7irgMKscyGulwpQMPNqQlKABtlhgzlQbLLIGHowhiMx50c\r\nFCo5JPJAI1rAAmYSaAxg4MInvXBjNHvhk6C8sbnK8w83r6UsV3jXjZH3Sb44wyxaOEt5PsljUFZh\r\nLOFJnmV2aeUwXJm8ZJnECK0BFjqNtH1KYEIWsoAFKkjBkXsN8iqSt4pOkwcyRzaHK82hLrKlmhXF\r\nNXXXlNyEqhgMCgOp8pW7wIVahMELtfhFr3Xt6zCAQQtl1oICZ\/yPM2NBzjNm84\/x\/K5AN8ZdY4m2\r\nW1rBYzbbOaBjSZ6PCW2w4t0akv9oDBeuUK4rYKv+2Xq5NBay8A9Mm6st5+KXjiW521aUp9RBvuWT\r\nn2y1U\/ODX6dOnuFUsacZ0XogVx6lsR+ei1yo28XXWqAuvADJGPfYXdSWpJslCZC9tGvj7bqLM9rF\r\nDykQnMjYaNdYJMmvQ7+CWQ1XoMVdrAuK58ILYCizArGl8aBLQdPL7nbC\/dGKZb950G++9rsok+lr\r\nu6UsLn+5nqzSFa2MYYHVXjaR55yFK0TcClq4tC7kDeOB1xvJe9WxMoinjh5Pm+MoV4dhAtPqc\/j7\r\nCcRtNY1ecZ6tHxuSNse4LsCw65733OZhMDPGdw7nP8f4zn\/+Rp95nG0ZA3otSe+6xrEt9ilM3uj+\r\neyJPwRh+iylsHVt6wQKvsZatbDWmXNnWMcpZTfCv3RvOQN44vavQ6dsCOce2Z4WTHYlLPUkyPIME\r\nvFbI0ALRBMEIhVISDOrqhGFj3OaFvzjGnZ1nzRddl1gaxw8IRwT4HXYHU9KYTzZ6hBJqoW0oqmtI\r\nx3FcJEhBTMg7NOrJEAMRgAEjMAIPAAEXsAIZwAEPMATu4GJspgsxBmPOsHFCpg4q9wRUAAtcYEUA\r\nNhJAAwI04AIF9gQ3QAIrkBMj8F8wUAI4wAQxAGZEgAMjsANEABIuQAMr0DEuEARjUHrOdyMLNEr6\r\ntgvxpnG54HrNtiffQGPmcmMXOHQJxwVtExf+WNAlTJB2HaFJ5sIKQrAEd6IOgyEFSmAuX5hCUEAn\r\nSqBj4IZ1qOdLVvFJbrZsZJcLFldJ2gZvXLcnYyFcSzBjYzFoXCAFYxADOggDUnBFwiEJMQAC\/ZUI\r\nM9AEI7AkIJADiaBFK9BbN7ACIFACS7AD7xQDLnADySUolrEFt4ZreqJ0Q3dbZDFjzBAXRkhsVJAF\r\nwzUWWcAFwmVmGjdoOSYFCrQER1AER\/CFx0AE0wdDxygE\/fEEQpBRQZAD4zMJO4QMbKMES3BcTIEn\r\nIQd4YzBuY5ADmBgDbMMDSiA+57ccknBQQaBGP7B\/PBBaRbADQXAMOAAh\/oFYPIA8CtQ\/2hP+BE+w\r\nA3eiA7m4AyuACmHAA\/11Ax1BA5nzBD\/QNjswFp4xAzigBFIQfQ1ySIlzilrBBV2QIkGAA0UQBDGw\r\nBDfgCA71Ay7YRhXJJEyQA0FALDeAA\/ZYBDSBkyUDA0ggiFzAA\/vFTEoAA0WAkqajVD5hjjEwAzHA\r\njjdQE5sjgzdQBEowWjTJA+vhG0OwkQmjMB5pBF7hJJcEUY4UhlDABQ2kBWMgGUnwi90miMOlBLnY\r\nlvvHL22JPMIlBTuCl8iVPM81MOdABDpmF+cyFmwjBd4wGI\/xlV7Blap3a\/6jDig4An6kBUaggixw\r\nAivgAiRwAph0VaWCEyEwkDigmSAQAqf+eZVFcJpBIIhjQAMgAAMgcAOMWIgA1gII1gI7oIIlcEUu\r\nIJurAxUZdkUrsDQlkDK8WQJPMnOCEnhQcJG4lZe4RQX14i5Y6FhMIIE3NhaEE5eVNlx9qIZa8ARq\r\n2G2mwwSV9pzXeJ6DEYZK0A3nCTc61jZN8IUGxQSTNBbgc5+MOXPeeGVkQAMjUIizCQM0MJIsUJUw\r\nwB8t0DlEUAShSJIxUAT9hQQrgCqieCArgAM78DA+OAZBoF5MQF+8yQQg0ALmGByHAFVGMBKrwTkc\r\nMptMkAjSAyqIojGHVGIGcWVX1jbtgQM3UB8+cFg+gAMrmUE+4BPHIJK6EQQWEpAgehH+K6kE9lg6\r\nY5EkARIEh+VU5kgx2jNaVwWROhBYq+OFOhAh4AOPJAkhrHF+zuKmXemfU0AEcHlcSmCNeUGFhjlB\r\nbsMm+sdDQ3AnRiBcRcAFT0AEYxA3UIBmKieo0aMEU3lcMtk2RqBjGSQ+UuBNROVclXafXEVDyaNO\r\n3rAFXJCjgQcRTwADV9QCKxACLBACN6AEK3BcIbACPqAEzrSqODirsAlmRSAEK\/AELjADdhpf+3gD\r\nIDADmtkBtIoCQWCaMDBf7IGJJQACoxFGJUCtLYCtOcAELAiDQ4AKQbACQ4AZuEaqgDIGM8Z1hskF\r\nWVAW7opmzzmNOSaRIIQ83zmFYxH+U8elnZXpWFOAjbZopX5oF3z3cmu4bExGnlbakxfIfAjDLFww\r\nBjqwEi6AA0sAAyHATGE2pTfwBBnRVCtAAh3AjhjgX8IBqzCAQSHgWIxIAjSwBIekBT+gE37UAkFQ\r\nMjirM1cEOiQwGiXgAiFQAkigiStwA8aJOtEnHDxgnAGGig03EApEj2xSBBP1qNbghSBEBWwDQnzY\r\nZFGCDFU7nuNpBAxVjPq3J9h4XHVajbqhjYAaPYTjOcbYJTREOHmZXDoiBUCycOchsVs3Bg8GAxe7\r\nBFhEk1QglCP5A2wDWZ3zA0yAQQdSBDowHTBkj0yykh53mFz1Ay\/CVQuJVlu1HoH+40wXGQNDUBqV\r\nFj3nNVXtMQVT9QTk4IZRa65FwBs4IARUSZO4qwQ+QJM8uJI4sF+4QgPy+DoQ8ig3wFUXQxNfFA6f\r\n1Dkadgg0ESmjpaHgpANUCTSehSgOKhzCwRsaA5P30CA7ynDj9pYqp0oJq2PClQVHMIZV4IdPkEl+\r\nCJeZxIeppIYwt4aA2HZEEGN\/M56bdH7ZwwVxE1hP4gQ\/pMDb6A8SCyXtYQTmu6PnKrE0MIDztQJI\r\ngAIhUIO02jJCMAO02qpiEgLzFQIjWUVCQKsZBgNKwImw2m0mCBVKMARxpBMnWQIkUAIowARJ4F+N\r\niC7\/VSxTEATQWoiiKEk\/iQr+TGC+ZFBr5rp\/cqEf43kkWQBCX\/idOACoHme\/UoAEWcyH\/GIMgEoW\r\n3aYEk6CGUHBcO2RcdlE4KveL+wLGkkQ4P\/wE4SGIyWWWW1AV3qgZZCAGV9Z4XIBYozUCqYIFN+AC\r\nTMkFE3qIOwCb0Po6MzAbWKCDNCAFNyyhS3CzS0CrNrQnRVACHAACQrAe2KoBV1kCMIAqBUpNMbAe\r\nh6gFNMMkOdAFMOkbU0ADq8OtVyYGwSwGH9l4YfAinRMEPaAf8xgEQroEy4i4aSyUPiEEpgPGROCF\r\nj5q1U2moi1t0fyMmRfAEyDCN+\/e5lAsEVWAmUjAJ+icZy7WdUbK3YBFrYxD+BmSAz1AseIVKJ1Mp\r\njJsUjAwVxsLIULkYBFjwhblrp5k0lYmBJ2zcZEWnhlNpJjP0kEOADISTBI7FJmVbBGM4jehSIBt9\r\nDGPABC7wXLUwBvlsZeY6BvOFA2F2MlQgKSuQAtAqil6UqjCwBDWZBThgCJrJ0zhwwr+buxVJhjG2\r\nVPiVrBoaBEBDEy\/wX2Z6McERTpRrBJ6TAxohprHBBLVcVVCQz\/n8kYIXa6uYabiFBVZwi3FmbNzH\r\nZmDgh+nbk8mTcNWmnXKmdKD0DyxWSW+9QGVmZf7pnwpkz\/e80ugx1rgmeKr3Ck54gTJmbIY3eDb3\r\nD1zgc+UxSg+sS65QdEX+V218HXmjetmEl2uIp2i3JmxmcNiHPdb4PNgQfEh4rSfusmyRV9oPV9lJ\r\n9ItuDRCWQXqUN2OPDWfcp0CIh9qpTci6Rti18NojpkBeEd21uIprVh6CV9j+CdjY\/daA+4vGfWyX\r\n\/cBegWteoDBVlmsKtGvCRgxg4I26ptLwvdL4nAZoANt\/q0CPKiZYUrY78ltolkrO2Qp9uAQ+yIdj\r\nQFzENYXjXKhtAwUbrSNskwRGIJ7bYlBOsCU8MihcEAVNgNm5pmi6lmjMbc9bd8+L7Y2Ax4IYQAIx\r\nwAIggALIiTREoLGNSAI4wJuMrAXLNAQugAVIQKs3IAVH5bE3EAIggAr+OQECGKABLYAB4RIDTaAD\r\nBEgCpqIBMNAFpPtNjYd4rU0M8m3PZ+BYafDao2pzOgKp4Vy1U5nFX9g2IHSeWuzm6bkEg4YuashQ\r\nT7AYMWSnMYKeQ1IFM9fXZtkFyO3eZRDfIe6fx8MF+IwGZM4VhGZ0Gahytr1s2+eNEEzYNrfPgCvb\r\n+L11gP3Wpf2R3LfeW8BrXL4FtdDlzM3cIzbfZEDmaUDmB6tj56Bjv7UvNiYFtWil0j14gM19xibd\r\nmv3AgghKpkfsMvtzlS1sZZbc8K3osH7i9U3raaAjbWOfgnlvwc2whg3ewwbeQkjuEGdsY6HZo3Tc\r\nb91z7K54IS7tyu0Jn\/SNBvWOBoEAADs=\r\n",
        "names": [
          {
            "namestring": "Crunomys suncoides",
            "identifiers": {
              "namebankID": 6071872
            },
            "pages": [
              2849316,
              2849317,
              2849359,
              2849370
            ]
          },
          {
            "namestring": "Molossidae",
            "identifiers": {
              "namebankID": 2477970
            },
            "pages": [
              2849316,
              2849353
            ]
          },
          {
            "namestring": "Vespertilionidae",
            "identifiers": {
              "namebankID": 2477611
            },
            "pages": [
              2849316,
              2849350
            ]
          },
          {
            "namestring": "Tupaiidae",
            "identifiers": {
              "namebankID": 2481825
            },
            "pages": [
              2849316,
              2849336
            ]
          },
          {
            "namestring": "Erinaceidae",
            "identifiers": {
              "namebankID": 2479414
            },
            "pages": [
              2849316,
              2849329
            ]
          },
          {
            "namestring": "Rhinolophidae",
            "identifiers": {
              "namebankID": 2476935
            },
            "pages": [
              2849316,
              2849346
            ]
          },
          {
            "namestring": "Tarsiidae",
            "identifiers": {
              "namebankID": 2481565
            },
            "pages": [
              2849316,
              2849354
            ]
          },
          {
            "namestring": "Sciuridae",
            "identifiers": {
              "namebankID": 2481857
            },
            "pages": [
              2849316,
              2849354,
              2849374
            ]
          },
          {
            "namestring": "Suidae",
            "identifiers": {
              "namebankID": 2478649
            },
            "pages": [
              2849316,
              2849366
            ]
          },
          {
            "namestring": "Viverridae",
            "identifiers": {
              "namebankID": 2478429
            },
            "pages": [
              2849316,
              2849365
            ]
          },
          {
            "namestring": "Pteropodidae",
            "identifiers": {
              "namebankID": 2477081
            },
            "pages": [
              2849316,
              2849337,
              2849374,
              2849375,
              2849376,
              2849377
            ]
          },
          {
            "namestring": "Soricidae",
            "identifiers": {
              "namebankID": 2479444
            },
            "pages": [
              2849316,
              2849333
            ]
          },
          {
            "namestring": "Alionycteris paucidentata",
            "identifiers": {
              "namebankID": 2477093
            },
            "pages": [
              2849316,
              2849317,
              2849337,
              2849341,
              2849369
            ]
          },
          {
            "namestring": "Limnomys",
            "identifiers": {
              "namebankID": 2481054
            },
            "pages": [
              2849316,
              2849360,
              2849375,
              2849376
            ]
          },
          {
            "namestring": "Cercopithecidae",
            "identifiers": {
              "namebankID": 2481623
            },
            "pages": [
              2849316,
              2849354
            ]
          },
          {
            "namestring": "Cynocephalidae",
            "identifiers": {
              "namebankID": 2481850
            },
            "pages": [
              2849316,
              2849336
            ]
          },
          {
            "namestring": "Muridae",
            "identifiers": {
              "namebankID": 2480343
            },
            "pages": [
              2849316,
              2849356,
              2849373,
              2849374,
              2849376,
              2849377
            ]
          },
          {
            "namestring": "Cervidae",
            "identifiers": {
              "namebankID": 2478694
            },
            "pages": [
              2849316,
              2849366,
              2849373
            ]
          },
          {
            "namestring": "Batomys russatus",
            "identifiers": {
              "namebankID": 6066019
            },
            "pages": [
              2849317
            ]
          },
          {
            "namestring": "Crateromys australis",
            "identifiers": {
              "namebankID": 2480937
            },
            "pages": [
              2849317
            ]
          },
          {
            "namestring": "Limnomys bryophilus",
            "identifiers": {
              "namebankID": 5507396
            },
            "pages": [
              2849317,
              2849333,
              2849360,
              2849362,
              2849370
            ]
          },
          {
            "namestring": "Apomys",
            "identifiers": {
              "namebankID": 2480863
            },
            "pages": [
              2849317,
              2849357,
              2849366,
              2849374,
              2849376,
              2849377
            ]
          },
          {
            "namestring": "Podogymnura aureospinula",
            "identifiers": {
              "namebankID": 2479442
            },
            "pages": [
              2849317,
              2849329
            ]
          },
          {
            "namestring": "Rhododendron",
            "identifiers": {
              "namebankID": 2649209
            },
            "pages": [
              2849323,
              2849326
            ]
          },
          {
            "namestring": "Podocarpaceae",
            "identifiers": {
              "namebankID": 447287
            },
            "pages": [
              2849323
            ]
          },
          {
            "namestring": "Melastoma",
            "identifiers": {
              "namebankID": 2665272
            },
            "pages": [
              2849323,
              2849325
            ]
          },
          {
            "namestring": "Dipterocarpaceae",
            "identifiers": {
              "namebankID": 450101
            },
            "pages": [
              2849323
            ]
          },
          {
            "namestring": "Polysoma",
            "identifiers": {
              "namebankID": 2996919
            },
            "pages": [
              2849323
            ]
          },
          {
            "namestring": "Elaeocarpus",
            "identifiers": {
              "namebankID": 2647542
            },
            "pages": [
              2849323,
              2849328,
              2849344
            ]
          },
          {
            "namestring": "Dacrydium",
            "identifiers": {
              "namebankID": 232004
            },
            "pages": [
              2849323,
              2849326
            ]
          },
          {
            "namestring": "Litsea",
            "identifiers": {
              "namebankID": 2645144
            },
            "pages": [
              2849323
            ]
          },
          {
            "namestring": "Phyllocladus",
            "identifiers": {
              "namebankID": 2665464
            },
            "pages": [
              2849323,
              2849325,
              2849326
            ]
          },
          {
            "namestring": "Podocarpus",
            "identifiers": {
              "namebankID": 2576468
            },
            "pages": [
              2849323
            ]
          },
          {
            "namestring": "Cyathea",
            "identifiers": {
              "namebankID": 2576521
            },
            "pages": [
              2849323
            ]
          },
          {
            "namestring": "Lithocarpus",
            "identifiers": {
              "namebankID": 2646003
            },
            "pages": [
              2849323,
              2849328
            ]
          },
          {
            "namestring": "Cinnamomum",
            "identifiers": {
              "namebankID": 2645123
            },
            "pages": [
              2849323,
              2849325,
              2849328
            ]
          },
          {
            "namestring": "Imperata",
            "identifiers": {
              "namebankID": 2576457
            },
            "pages": [
              2849323
            ]
          },
          {
            "namestring": "Agathis",
            "identifiers": {
              "namebankID": 2813825
            },
            "pages": [
              2849324
            ]
          },
          {
            "namestring": "Pteropus vampyrus",
            "identifiers": {
              "namebankID": 2477247
            },
            "pages": [
              2849324,
              2849327,
              2849337,
              2849345
            ]
          },
          {
            "namestring": "Freycinetia",
            "identifiers": {
              "namebankID": 2665156
            },
            "pages": [
              2849325
            ]
          },
          {
            "namestring": "Calamus",
            "identifiers": {
              "namebankID": 4935117
            },
            "pages": [
              2849325
            ]
          },
          {
            "namestring": "Rubus",
            "identifiers": {
              "namebankID": 2576519
            },
            "pages": [
              2849325
            ]
          },
          {
            "namestring": "Pandanus",
            "identifiers": {
              "namebankID": 2576463
            },
            "pages": [
              2849325
            ]
          },
          {
            "namestring": "Clethra canescens",
            "identifiers": {
              "namebankID": 1778111
            },
            "pages": [
              2849326
            ]
          },
          {
            "namestring": "Drimys piperita",
            "identifiers": {
              "namebankID": 5860311
            },
            "pages": [
              2849326
            ]
          },
          {
            "namestring": "Alphitonia philippinensis",
            "identifiers": {
              "namebankID": 8694991
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Actinodaphne",
            "identifiers": {
              "namebankID": 1846972
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Melastoma malabathricum",
            "identifiers": {
              "namebankID": 2668085
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Michelia philippinensis",
            "identifiers": {
              "namebankID": 3905739
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Phyllocladus hypophyllus",
            "identifiers": {
              "namebankID": 3497202
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Helicia",
            "identifiers": {
              "namebankID": 243072
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Lasianthus",
            "identifiers": {
              "namebankID": 2657110
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Aralia bipinnata",
            "identifiers": {
              "namebankID": 5823339
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Trema",
            "identifiers": {
              "namebankID": 275595
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Gordonia luzonica",
            "identifiers": {
              "namebankID": 3424871
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Dodonaea angustifolia",
            "identifiers": {
              "namebankID": 9087431
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Alstonia macrophylla",
            "identifiers": {
              "namebankID": 2664136
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Prunus grisea",
            "identifiers": {
              "namebankID": 3462644
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Castanopsis",
            "identifiers": {
              "namebankID": 2646000
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Saurauia",
            "identifiers": {
              "namebankID": 1777876
            },
            "pages": [
              2849328
            ]
          },
          {
            "namestring": "Tarsomys echinatus",
            "identifiers": {
              "namebankID": 2481404
            },
            "pages": [
              2849329,
              2849365
            ]
          },
          {
            "namestring": "Eonycteris robusta",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849329,
              2849341,
              2849347
            ]
          },
          {
            "namestring": "Alionycteris",
            "identifiers": {
              "namebankID": 2477092
            },
            "pages": [
              2849329
            ]
          },
          {
            "namestring": "Limnomys sibuanus",
            "identifiers": {
              "namebankID": 2481055
            },
            "pages": [
              2849329,
              2849333,
              2849360,
              2849362,
              2849376
            ]
          },
          {
            "namestring": "Tarsius syrichta",
            "identifiers": {
              "namebankID": 2481569
            },
            "pages": [
              2849329,
              2849354,
              2849373,
              2849376
            ]
          },
          {
            "namestring": "Podogymnura truei",
            "identifiers": {
              "namebankID": 2479443
            },
            "pages": [
              2849329,
              2849331,
              2849333,
              2849356,
              2849365
            ]
          },
          {
            "namestring": "Hipposideros diadema",
            "identifiers": {
              "namebankID": 2477036
            },
            "pages": [
              2849329,
              2849347
            ]
          },
          {
            "namestring": "Eonycteris spelaea",
            "identifiers": {
              "namebankID": 2477272
            },
            "pages": [
              2849329,
              2849341,
              2849347
            ]
          },
          {
            "namestring": "Dyacopterus",
            "identifiers": {
              "namebankID": 2477122
            },
            "pages": [
              2849329,
              2849339
            ]
          },
          {
            "namestring": "Otopteropus cartilagonodus",
            "identifiers": {
              "namebankID": 2477179
            },
            "pages": [
              2849329,
              2849344
            ]
          },
          {
            "namestring": "Tarsomys apoensis",
            "identifiers": {
              "namebankID": 2481403
            },
            "pages": [
              2849330,
              2849333,
              2849365
            ]
          },
          {
            "namestring": "Chrotomys",
            "identifiers": {
              "namebankID": 2480922
            },
            "pages": [
              2849331,
              2849357,
              2849376
            ]
          },
          {
            "namestring": "Rhynchomys",
            "identifiers": {
              "namebankID": 2481367
            },
            "pages": [
              2849331,
              2849357,
              2849365
            ]
          },
          {
            "namestring": "Apomys hylocoetes",
            "identifiers": {
              "namebankID": 2480866
            },
            "pages": [
              2849333,
              2849356,
              2849357
            ]
          },
          {
            "namestring": "Crocidura beatus",
            "identifiers": {
              "namebankID": 2479459
            },
            "pages": [
              2849333,
              2849363
            ]
          },
          {
            "namestring": "Apomys insignis",
            "identifiers": {
              "namebankID": 2480867
            },
            "pages": [
              2849333,
              2849357,
              2849364
            ]
          },
          {
            "namestring": "Batomys salomonseni",
            "identifiers": {
              "namebankID": 2480887
            },
            "pages": [
              2849333,
              2849358,
              2849370
            ]
          },
          {
            "namestring": "Suncus minimis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849334
            ]
          },
          {
            "namestring": "Suncus murinus",
            "identifiers": {
              "namebankID": 2479638
            },
            "pages": [
              2849334,
              2849364,
              2849371
            ]
          },
          {
            "namestring": "Urogale everetti",
            "identifiers": {
              "namebankID": 2481845
            },
            "pages": [
              2849336
            ]
          },
          {
            "namestring": "Scandentia",
            "identifiers": {
              "namebankID": 2481824
            },
            "pages": [
              2849336
            ]
          },
          {
            "namestring": "Cynocephalus volans",
            "identifiers": {
              "namebankID": 2481853
            },
            "pages": [
              2849336,
              2849377
            ]
          },
          {
            "namestring": "Dermoptera",
            "identifiers": {
              "namebankID": 2481849
            },
            "pages": [
              2849336,
              2849376
            ]
          },
          {
            "namestring": "Acerodon jubatus",
            "identifiers": {
              "namebankID": 2477086
            },
            "pages": [
              2849337,
              2849345,
              2849377
            ]
          },
          {
            "namestring": "Chiroptera",
            "identifiers": {
              "namebankID": 2476934
            },
            "pages": [
              2849337,
              2849375,
              2849376,
              2849377
            ]
          },
          {
            "namestring": "Haplonycteris fischeri",
            "identifiers": {
              "namebankID": 2477138
            },
            "pages": [
              2849337,
              2849341,
              2849344,
              2849369,
              2849374,
              2849377
            ]
          },
          {
            "namestring": "Cynopterus brachyotis",
            "identifiers": {
              "namebankID": 2477105
            },
            "pages": [
              2849337,
              2849373
            ]
          },
          {
            "namestring": "Ptenochirus",
            "identifiers": {
              "namebankID": 2477186
            },
            "pages": [
              2849338,
              2849344,
              2849345,
              2849377
            ]
          },
          {
            "namestring": "Dyacopterus spadiceus",
            "identifiers": {
              "namebankID": 2477123
            },
            "pages": [
              2849339,
              2849375
            ]
          },
          {
            "namestring": "Pteropodinae",
            "identifiers": {
              "namebankID": 2477082
            },
            "pages": [
              2849342
            ]
          },
          {
            "namestring": "Harpyionycteris whiteheadi",
            "identifiers": {
              "namebankID": 2477141
            },
            "pages": [
              2849342
            ]
          },
          {
            "namestring": "Macroglossus minimus",
            "identifiers": {
              "namebankID": 2477273
            },
            "pages": [
              2849343
            ]
          },
          {
            "namestring": "Megaerops wetmorei",
            "identifiers": {
              "namebankID": 2477150
            },
            "pages": [
              2849343
            ]
          },
          {
            "namestring": "Ptenochirus jagori",
            "identifiers": {
              "namebankID": 2477187
            },
            "pages": [
              2849343,
              2849344,
              2849345,
              2849375
            ]
          },
          {
            "namestring": "Musa minimus",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849343
            ]
          },
          {
            "namestring": "Primus",
            "identifiers": {
              "namebankID": 4576658
            },
            "pages": [
              2849344
            ]
          },
          {
            "namestring": "Ptenochirus minor",
            "identifiers": {
              "namebankID": 2477188
            },
            "pages": [
              2849344
            ]
          },
          {
            "namestring": "Primus jagori",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849344
            ]
          },
          {
            "namestring": "Pteropus jagori",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849345
            ]
          },
          {
            "namestring": "Erythrina",
            "identifiers": {
              "namebankID": 592561
            },
            "pages": [
              2849345
            ]
          },
          {
            "namestring": "Rousettus",
            "identifiers": {
              "namebankID": 2477251
            },
            "pages": [
              2849345
            ]
          },
          {
            "namestring": "Coelops",
            "identifiers": {
              "namebankID": 2477013
            },
            "pages": [
              2849346
            ]
          },
          {
            "namestring": "Coelops hirsutus",
            "identifiers": {
              "namebankID": 2477015
            },
            "pages": [
              2849346,
              2849347,
              2849373
            ]
          },
          {
            "namestring": "Coelops robinsoni",
            "identifiers": {
              "namebankID": 2477016
            },
            "pages": [
              2849347
            ]
          },
          {
            "namestring": "Hipposideros obscurus",
            "identifiers": {
              "namebankID": 2477057
            },
            "pages": [
              2849347
            ]
          },
          {
            "namestring": "Rhinolophus arcuatus",
            "identifiers": {
              "namebankID": 2476943
            },
            "pages": [
              2849349
            ]
          },
          {
            "namestring": "Suma tra",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849349
            ]
          },
          {
            "namestring": "Rhinolophus",
            "identifiers": {
              "namebankID": 2476937
            },
            "pages": [
              2849349
            ]
          },
          {
            "namestring": "Rhinolophus inops",
            "identifiers": {
              "namebankID": 2476966
            },
            "pages": [
              2849349
            ]
          },
          {
            "namestring": "Rhinolophus macrotis",
            "identifiers": {
              "namebankID": 2476972
            },
            "pages": [
              2849349
            ]
          },
          {
            "namestring": "Miniopterus australis",
            "identifiers": {
              "namebankID": 2477953
            },
            "pages": [
              2849350
            ]
          },
          {
            "namestring": "Kerivoula hardwickii",
            "identifiers": {
              "namebankID": 2477622
            },
            "pages": [
              2849350
            ]
          },
          {
            "namestring": "Kerivoula",
            "identifiers": {
              "namebankID": 2477613
            },
            "pages": [
              2849350
            ]
          },
          {
            "namestring": "Miniopterus schreibersi",
            "identifiers": {
              "namebankID": 2477961
            },
            "pages": [
              2849350
            ]
          },
          {
            "namestring": "Myotis ater",
            "identifiers": {
              "namebankID": 113748
            },
            "pages": [
              2849352
            ]
          },
          {
            "namestring": "Myotis muricola browni",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849352
            ]
          },
          {
            "namestring": "Myotis nugax",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849352
            ]
          },
          {
            "namestring": "Philetor brachypterus",
            "identifiers": {
              "namebankID": 2477842
            },
            "pages": [
              2849352
            ]
          },
          {
            "namestring": "Myotis muricola bronni",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849352
            ]
          },
          {
            "namestring": "Myotis ridleyi",
            "identifiers": {
              "namebankID": 2477796
            },
            "pages": [
              2849352
            ]
          },
          {
            "namestring": "Myotis",
            "identifiers": {
              "namebankID": 2477731
            },
            "pages": [
              2849352
            ]
          },
          {
            "namestring": "Murina cyclotis",
            "identifiers": {
              "namebankID": 2477938
            },
            "pages": [
              2849352
            ]
          },
          {
            "namestring": "Myotis muricola",
            "identifiers": {
              "namebankID": 2477782
            },
            "pages": [
              2849352
            ]
          },
          {
            "namestring": "Pipistrellus tenuis",
            "identifiers": {
              "namebankID": 2477893
            },
            "pages": [
              2849353
            ]
          },
          {
            "namestring": "Pipistrellus javanicus",
            "identifiers": {
              "namebankID": 2477865
            },
            "pages": [
              2849353
            ]
          },
          {
            "namestring": "Pipistrellus",
            "identifiers": {
              "namebankID": 2477843
            },
            "pages": [
              2849353
            ]
          },
          {
            "namestring": "Otomops",
            "identifiers": {
              "namebankID": 2478044
            },
            "pages": [
              2849353
            ]
          },
          {
            "namestring": "Tamias",
            "identifiers": {
              "namebankID": 2482081
            },
            "pages": [
              2849354
            ]
          },
          {
            "namestring": "Exilisciurus concinnus",
            "identifiers": {
              "namebankID": 2481898
            },
            "pages": [
              2849354
            ]
          },
          {
            "namestring": "Macaca fascicularis",
            "identifiers": {
              "namebankID": 2481656
            },
            "pages": [
              2849354,
              2849373
            ]
          },
          {
            "namestring": "Rodentia",
            "identifiers": {
              "namebankID": 2476907
            },
            "pages": [
              2849354,
              2849373,
              2849374,
              2849376,
              2849377
            ]
          },
          {
            "namestring": "None",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849356,
              2849365
            ]
          },
          {
            "namestring": "Petinomys erinitus",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849356
            ]
          },
          {
            "namestring": "Sundasciurus philippinensis",
            "identifiers": {
              "namebankID": 2482074
            },
            "pages": [
              2849356
            ]
          },
          {
            "namestring": "Apomys littoralis",
            "identifiers": {
              "namebankID": 2480868
            },
            "pages": [
              2849357
            ]
          },
          {
            "namestring": "Carpomys",
            "identifiers": {
              "namebankID": 2480904
            },
            "pages": [
              2849358
            ]
          },
          {
            "namestring": "Phloeomys",
            "identifiers": {
              "namebankID": 2481255
            },
            "pages": [
              2849358
            ]
          },
          {
            "namestring": "Crateromys",
            "identifiers": {
              "namebankID": 2480936
            },
            "pages": [
              2849358
            ]
          },
          {
            "namestring": "Batomys",
            "identifiers": {
              "namebankID": 2480884
            },
            "pages": [
              2849358,
              2849376
            ]
          },
          {
            "namestring": "Sundamys",
            "identifiers": {
              "namebankID": 2481391
            },
            "pages": [
              2849359
            ]
          },
          {
            "namestring": "Crunomys melanius",
            "identifiers": {
              "namebankID": 2480949
            },
            "pages": [
              2849359
            ]
          },
          {
            "namestring": "Bullimus",
            "identifiers": {
              "namebankID": 2480893
            },
            "pages": [
              2849359,
              2849376
            ]
          },
          {
            "namestring": "Bullimus luzonicus",
            "identifiers": {
              "namebankID": 2480895
            },
            "pages": [
              2849359
            ]
          },
          {
            "namestring": "Rattus everetti",
            "identifiers": {
              "namebankID": 2481318
            },
            "pages": [
              2849359,
              2849360,
              2849362
            ]
          },
          {
            "namestring": "Maxomys",
            "identifiers": {
              "namebankID": 2481096
            },
            "pages": [
              2849359
            ]
          },
          {
            "namestring": "Bullimus gamay",
            "identifiers": {
              "namebankID": 5589461
            },
            "pages": [
              2849359
            ]
          },
          {
            "namestring": "Crunomys",
            "identifiers": {
              "namebankID": 2480946
            },
            "pages": [
              2849359,
              2849376
            ]
          },
          {
            "namestring": "Tarsomys",
            "identifiers": {
              "namebankID": 2481402
            },
            "pages": [
              2849360
            ]
          },
          {
            "namestring": "Apomys musculus",
            "identifiers": {
              "namebankID": 2480870
            },
            "pages": [
              2849360
            ]
          },
          {
            "namestring": "Archboldomys luzonensis",
            "identifiers": {
              "namebankID": 2480873
            },
            "pages": [
              2849360
            ]
          },
          {
            "namestring": "Rattus tanezumi",
            "identifiers": {
              "namebankID": 2481357
            },
            "pages": [
              2849362,
              2849364,
              2849371
            ]
          },
          {
            "namestring": "Mus musculus",
            "identifiers": {
              "namebankID": 2481174
            },
            "pages": [
              2849362,
              2849364
            ]
          },
          {
            "namestring": "Rattus exulans",
            "identifiers": {
              "namebankID": 2481319
            },
            "pages": [
              2849362,
              2849363,
              2849364,
              2849371
            ]
          },
          {
            "namestring": "Rattus mindanensis",
            "identifiers": {
              "namebankID": 6916331
            },
            "pages": [
              2849364
            ]
          },
          {
            "namestring": "Rattus rattus mindanensis",
            "identifiers": {
              "namebankID": 5796747
            },
            "pages": [
              2849364
            ]
          },
          {
            "namestring": "Crunomys celebensis",
            "identifiers": {
              "namebankID": 2480947
            },
            "pages": [
              2849365
            ]
          },
          {
            "namestring": "Rhynchomys isarogensis",
            "identifiers": {
              "namebankID": 2481368
            },
            "pages": [
              2849365
            ]
          },
          {
            "namestring": "Paradoxurus hermaphroditus",
            "identifiers": {
              "namebankID": 2478460
            },
            "pages": [
              2849365,
              2849366
            ]
          },
          {
            "namestring": "Melasmothrix naso",
            "identifiers": {
              "namebankID": 2481117
            },
            "pages": [
              2849365
            ]
          },
          {
            "namestring": "Carnivora",
            "identifiers": {
              "namebankID": 2478066
            },
            "pages": [
              2849365
            ]
          },
          {
            "namestring": "Artiodactyla",
            "identifiers": {
              "namebankID": 2478648
            },
            "pages": [
              2849366
            ]
          },
          {
            "namestring": "Imperata cylindrica",
            "identifiers": {
              "namebankID": 2576458
            },
            "pages": [
              2849366
            ]
          },
          {
            "namestring": "Cervus mariannus",
            "identifiers": {
              "namebankID": 2478949
            },
            "pages": [
              2849366
            ]
          },
          {
            "namestring": "Sus philippensis",
            "identifiers": {
              "namebankID": 2478940
            },
            "pages": [
              2849366
            ]
          },
          {
            "namestring": "Crocidura grandis",
            "identifiers": {
              "namebankID": 2479494
            },
            "pages": [
              2849371
            ]
          },
          {
            "namestring": "Rattus rattus",
            "identifiers": {
              "namebankID": 2481350
            },
            "pages": [
              2849371
            ]
          },
          {
            "namestring": "Averia",
            "identifiers": {
              "namebankID": 3432209
            },
            "pages": [
              2849372
            ]
          },
          {
            "namestring": "Rattus",
            "identifiers": {
              "namebankID": 2481308
            },
            "pages": [
              2849373
            ]
          },
          {
            "namestring": "Murinae",
            "identifiers": {
              "namebankID": 2480810
            },
            "pages": [
              2849373,
              2849376,
              2849377
            ]
          },
          {
            "namestring": "Mammalia",
            "identifiers": {
              "namebankID": 2478620
            },
            "pages": [
              2849373,
              2849375,
              2849376
            ]
          },
          {
            "namestring": "Memoria",
            "identifiers": {
              "namebankID": 4505704
            },
            "pages": [
              2849373
            ]
          },
          {
            "namestring": "Nannosciurus",
            "identifiers": {
              "namebankID": 2481957
            },
            "pages": [
              2849374
            ]
          },
          {
            "namestring": "Megachiroptera",
            "identifiers": {
              "namebankID": 2721449
            },
            "pages": [
              2849374,
              2849375
            ]
          },
          {
            "namestring": "Nusa",
            "identifiers": {
              "namebankID": 2946732
            },
            "pages": [
              2849375
            ]
          },
          {
            "namestring": "Limnomys planus",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849375
            ]
          },
          {
            "namestring": "Cynopterus",
            "identifiers": {
              "namebankID": 2477104
            },
            "pages": [
              2849375
            ]
          },
          {
            "namestring": "Haplonycteris",
            "identifiers": {
              "namebankID": 2477137
            },
            "pages": [
              2849376
            ]
          },
          {
            "namestring": "Cervus alfredi",
            "identifiers": {
              "namebankID": 2478948
            },
            "pages": [
              2849376
            ]
          },
          {
            "namestring": "Archboldomys",
            "identifiers": {
              "namebankID": 2480872
            },
            "pages": [
              2849376
            ]
          },
          {
            "namestring": "Insectivora",
            "identifiers": {
              "namebankID": 2479346
            },
            "pages": [
              2849376
            ]
          },
          {
            "namestring": "Pteropus vam pyrus lanensis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2849377
            ]
          }
        ]
      },
      "biostor\/65937": {
        "_id": "biostor\/65937",
        "_rev": "1-df486cc293d3a3c49be03b7d0f17fb89",
        "author": [
          {
            "firstname": "L R",
            "lastname": "Heaney",
            "name": "L R Heaney"
          },
          {
            "firstname": "B R",
            "lastname": "Tabaranza",
            "name": "B R Tabaranza"
          }
        ],
        "type": "article",
        "title": "A New Species of Forest Mouse, Genus Apomys (Mammalia: Rodentia: Muridae), from Camiguin Island, Philippines",
        "journal": {
          "name": "Fieldiana Zoology",
          "volume": "106",
          "pages": "14--27",
          "identifier": [
            {
              "type": "issn",
              "id": "0015-0754"
            }
          ]
        },
        "year": "2006",
        "link": [
          {
            "anchor": "LINK",
            "url": "http:\/\/biostor.org\/reference\/65937"
          },
          {
            "anchor": "LINK",
            "url": "http:\/\/www.biodiversitylibrary.org\/page\/2853531"
          }
        ],
        "identifier": [
          {
            "type": "biostor",
            "id": 65937
          },
          {
            "type": "bhl",
            "id": 2853531
          },
          {
            "type": "doi",
            "id": "10.3158\/0015-0754(2006)106[14:ANSOFM]2.0.CO;2"
          }
        ],
        "provenance": {
          "biostor": {
            "time": "2013-03-11T16:33:35+0000",
            "url": "http:\/\/biostor.org\/reference\/65937.json"
          }
        },
        "citation": "L R Heaney, B R Tabaranza (2006) A New Species of Forest Mouse, Genus Apomys (Mammalia: Rodentia: Muridae), from Camiguin Island, Philippines. Fieldiana Zoology, 106: 14--27",
        "thumbnail": "data:image\/gif;base64,R0lGODlhZACdAPYAAHx+fX1+gIKDg4aIhoeGiYeJiYuMjI6Qjo6OkI+RkJOUlJaYl5iYl5WWmJeZ\r\nmZucm5+gnqChnp6foZ+goaOjo6eopqmpp6amqainqaepqaytrK+wrrGxrq2tsbGvsq+xsbS0tLi3\r\nt7e4trq7t7a1ubm3ube4uby8vMC\/v77AvcHCvr6+wMG\/wb\/BwcTExMjGx8fJxsnJx8bGyMjHycfJ\r\nycvMy9DPzs\/QztHRz87P0NHP0M\/R0dPU09jX1tfZ1tna1tfX2NjX2NfZ2Nzd2uDf3t7h3eHi3uHf\r\n4OTl4ujn5Obp5Onr5uzt6fDv6+\/x5u7x6\/Lz7fb47\/v\/7\/T28fb68\/v+9fz++QAAAAAAAAAAAAAA\r\nAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\r\nAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5\r\nBAAAAAAALAAAAABkAJ0AAAf+gFVSUoKDhoeIiYZRVFVVVFaQkZBUkpORVlJRg5uag1SInYaFhKWm\r\nhY6CjqWppIiuirGVVlWYs5eTlJWVjLuepqCDsKSuq8WqrbCmwoqriLuUmFbS0NKTn9iVUtDbzMSj\r\nzqrMp6newuKsia6607rul9Da8d3B2uOExKjpyMnG58iHAI57xG6WJIMHqyEk6AhUpUfOQOU7h89b\r\nMlbKMIrjdyqerV3t3CWEVisSxIeNSApMR7GcuVajYsLUGFHkx2g4FYY02ZBgI5\/+wuEzRvTiKZr8\r\nnFVUhRAkPJ3xojZMeVJQo6H\/hpZz2Q9VUq39UO56BC9XVJAFFaakhRLio6X+XZPCJEoR7tauBs3e\r\nimZLL1qnY9sG\/Sk3LlZy\/+Km\/CmyscezZkNOndVz20mwcTO3zNyzIS3PCHGlfUxlSlqeOD8nVc25\r\nluuJyVi3osX2puh3Tq0oOfjkr2TCrRjPdiT7dT+Lw6elUv7wo1+9N6kwkY7EyhMo09hSpty6n3Li\r\ntMOjK0zbOHHfZc\/m1R1ph5UlUCi5Ls+Ts+ryxPN\/prV5uX7jBzmHXkG5VIdEEVUw0Zt6BrlFVVes\r\n7effVpjlZ2FxKFGTy1O2KGHdEtY9QdB+YtXyUEmE3TfcfPglJp5yME54nom1rbfXJEbcooSIfiUU\r\nHHDgWbjcfZ\/RVJxiIUH+YmJuoUVThRJFRFlEdSh6pmFn3pUUHn3fUQihjD\/Stlh06WFSElmR9cUd\r\njSaalyWLyu0TZHftaCdgajn9NWZfrp0Ym38xBupmhf\/NF5uSNAao5k5J8hVZPGRhmdmRFxU2YZc\/\r\n5kfVJeCpxeh6JtXnVndx4ffNpSsamsp26U3lXHTs6EfSiZS+CWZQF9Y6IZDl\/aQiQfF1CiMURUSh\r\nZZdUYJfdsoKKZxQ\/UWA3BQ23KFcEj6k48UR2JcFArAtQPCIiJEL0JsETGuz4BBJMVLEEJExo4MQS\r\nB\/ogBA48hGsFBjHw8MO\/NcjAg782SIgfa+BIYUUNE0RCgQZD1EADCNX+bXACDiPUsAMPN7gAgwtI\r\nUDGCCydYgQMHRowAQgojqACCA0VYAcIHH5iwAQQJXEDBAzH7wLMII4iQgAEDODCCbhSo0AAFEURg\r\nAAEhWFDDAzB+x22RREVhhAJMQAHFCRqA8AMFSFRRhAocaMDBDif8wAEMQtwgMg4F+5BvDDEgAYMR\r\nPMQg4oEwFIGDDy4UEYMPQ8SMxA9FMI44D0wwYd0UI9hAxRJMJOGEC0NA0cSvbm5kzHRVYFdFFMui\r\nHoMRrjrRCC36Zid5dk884YQPtDkRhRKoT9NuFVPcAKcVUKjQOS9VzADF7lTU4HWWEqJDiNYg0OBC\r\nClNAscSORijh9Q3+MSzxxBJVOJFBCtsvYQGU\/tZwgxFDVOfDBDxcEHcLKaQAwQ003MBDCx4qwvli\r\nAIIRVKABVQAB1VLwABA04AEa2IAFLGAACjjAAAYT1GqGMAIkOEBtYVPABxeggBFEIAUaYCAPouCE\r\nA3AAhU2rAAwc8EIRaAACRaDCE0SQgg1oYAL5WwAQDzCBG8DgBFRAwgdagAMKbIADDYCCETaQQAWE\r\nYAMUCMEDLiACCErQWJg6jjeYUAN69U0FNVDB4Nz3gxpAaQg44F0UomQEIxTBB0VYghG254QpKaEK\r\nInqCErZ3HSfsyHVOMAISegOFcZ0uP1Mw2A9c4CtuaUlI+lBFDSL+UZ3sJGF2PBjCD6ighMT1zgoh\r\nY5YqX2cJVTKLlTtREncs+SdAdYkiUWAAD2rAgV2CYAcS4IEVpvAAA4LABSA4AQyOCYJmduAEJNtW\r\nWeqkJ+egSE2pYchr9mPJqgHEEVGIwAkooEAITOABDnAB+RomAwpU4ARgowAHMtBMDlBACCeoToAc\r\nlRe0bKgvGgqVJIYUmy5NQyZPKp0gvTaF8YEoklFghLFqMAQeUAlGlsBTkzaUk\/QgyjwHY9axvEQI\r\nVzrrTODxpmzMJBpsfkRLtOJTO1pjqvJYJEbesRp9ShIsWy5Llo5y5Yis4x5qzkhXxyoSOKhghGXN\r\n53VFEJ4VBtb+rmEOkwo8ENEUplDKhZmgBYK0ghEmEMAUUGEHNGCCEKK0gyIIQQiRFOAieeCTmNLJ\r\nqXQhxBI0AIUOdIAEK2DBOGVAgiqcQAGR7MAGPlCDDFBgAi5oASRaIIEJOMA9+vvhBISABAHsgApF\r\nyB8ELjCBBrRgAgmYwAcmINkWMNZD1HiQg\/rUp4F+BxxRiF\/eigC\/iA1BCE8Swh+RACUl+OBAB5oG\r\nEoi7yPfsaEeVqJ0kTKOh0lhhdibNrnZdmZikbve72dlLJRoJBSYo4bxKWK4S7HggKRVhBzu4gcRo\r\nAAMZtKAFkXVBflsAzxPMDAQd0ICAMZABDGjAwBcYQiZOYQT+BjygAQ1YgAMW8IAHQMAB55RAhR8g\r\nAQc0IAEJQEACPgziEkNYAQcogAEKIAABBODFARAAAF5cAAQgQAE4BjECVFyAAhCgxwawsQLOqTMK\r\nGHkCO9MwhxnggAo3mcMKECZcooCDf\/2rCImro5aRoEjiohe9CrrOVtVjDfCa+cwmfQmawZvR8MJK\r\nT2QWS1v8NIk2rapOuCpULXPKl6ZwdFGt5GisxPRRpJ7JqQHBh0qdajWY8hPQuBB0mR8NqkkNSaR3\r\nyZWQaLnNhMR2UbY5DZ6qy+lbVY02yGGRjK7m5p+mBtAjAShAO9rnMBZKlQJJTk3vvM9X22Qko24S\r\nrWcNIW7+JtUrX5KRpwm0z1m7uRoeneaN1qRrk\/pD0ds0jnb6rFFYS1rUtO51nS29peykejaqGUuk\r\nP\/VtDnnkKc3uqDXIjWvRpYqbrvZos50d0BtxyN0H2fOlwtPdkuIn2GVKE7PFK15YnyYXBNW0KuU0\r\npzANmx0u7Se0ofIqZpvJ0sfOxDdpSs2Wtjre1sB4P7\/9cMOcmkb8GY99Vg5vUd9GLXk6eZ2maeuU\r\nbsnem06Gkp4dS9ukSbsev01AQe7zg3ZX1ShClMYRbiNIAAG+SgBCeoUAhJKPhpq6oJPPr41uQ0H8\r\nPA5XuXNO24AJdGAFBbhAC7zdlFpXCuQxJ09YiM73kiv+PFmVGPPU2S1uqhAKpa4596XxzUrckMaf\r\nDI9t3cvkT4SBNEgH5YiqjM3qnbN5zSYNqmgUZmxhsUUoYLrWE8Js3tWD6AlFUAJcBSnI864+ZLKP\r\n\/YGOoAQmLBcJdsOyRZcwhOIfYQqcBQISjvAEIbSgBi1gwhCOwAMl8IAFLPjBEixqhB4IwftAAIIO\r\nkmBJcqD7rDtYwg6EMIQc0ODqO1Br4t6PBBmg9f1cH8ISgODHHYR\/B0cgBD4gez6QAxuTdUOgAzwg\r\nBDwAXzuQdVy1XA9IAwz4BEaQBEbQBItDBD8QSjxABElABEHwOcuCUK0QSYd2NTr0SssiTdMQSfn2\r\ngtn+sVUBOAXvclW+0wROEUnNQTxeoy+QkD2lQYIwIiclpQQ5AFdIQAMVJQTwJQRnJQS+9wQt8H5A\r\nYIDOt0j31QJc54Cg1QJYmFVIkANU0DEzwAIrMAMaUwPNJwMaswJIIAQrkAMsEFlMEAQyQAU24ALK\r\n8wIowAI1AE8kQH5nMhD8MAXt0jVecx3wQTyRUDtds1Wrt3qSEzk7Mh278ARHUBrJwimzgDmRtCA8\r\naF0vyBBBSF3hQgURNQUR1Wj98R4gw1nm1XulkV4HAkjXcl6Rc11D0FZat3pcdyC3x1yQQ1w+8ATT\r\nlwT7JwNHwIYCxH7st31DwARMWAM10EY1MH5GUAP+NmADTTAFMjADknNKdkEbTMA3DAhfAdh8O9CL\r\nOyBIQJA4a+U9sueA5zUlLXAEQMAERZCETjiN7AeQDFhKvzUET4B8a5VH0pcEUxAExNUDRBCRPeA5\r\nQSCCDJkEPUCE\/HF43JJRQXULIvIIyiId6mEawBYNktNIiBhe1AUJShBJHlIFn7OKMilWQ6hqdbEc\r\nZMQDXYcEGiMENMADCFkFC8gDObAu\/hd+MoCIOWBfz7cDU9ACSACONPBZcrgCQekCvhcxViB+V6iA\r\nOqADMxAyLrACK3CQO+AuLqADNTADOvAvUGADQWCNhFgSGDEUtMAE1LUu4zUFIwIYPtGSkBdLDQX+\r\nPNNhFjL5DpNgGtjxE72jg8CDgj+HahSnG1UZJV62I1PCWcK1Lr9lgeuimVOyfEVwBA+oj0dwBNPI\r\nhO2HBPEDBAFoBSdQAtYoflSQBC7QgIEIBLlZA9toAy9QAyzgOjbAAjOAm2I5O3fhIlBgL3bzj\/Hn\r\nmkDQgOflhMwnhZwle9PHmbynVrFHL5GzlU+ggfpHBDb4A3V0BEigPfF4BNJXSkbABEsQkf8CglHQ\r\nBBjZkEeQBIWWMCW1JCV3kJwCSGNGah+hl6jEg7qxLdkTSZGzLldFkuyCSktgg5Gkf0uAnyHIBE3w\r\nA02gPR8KBTBIIVoxDUpAA2AIBDSAXO63Ay3+AF\/QB19wCH9VqDE7UAMrkHXvlVYo+qL1lwNAmgPL\r\nlwNhqQPht3xlpAM5oJ4skAM1YFEygAQ9IJw6IAM5wAQu0C9raZzKmXgVYh2lQV25YF6RYRomuRsb\r\nJ4N10hsp51RB6EpiyhYfGgkiqkoo+BoVcQ7T8ARAsFZIsH6RcwRRonxvdQRWwHVFEH5AMAX6mKim\r\nuS41oHUBGH5HQANcpZ46QAQ1wDlA8AJqOAUzMDD7GARhiQQsoANBMAQsQAQKyAMvoAQzAAQzAILC\r\nKQPKQhx32QrSx3tUwHu9sVxY5jm86nsPKIxCoJ7xk0PyV15MoJ7L1QS+BwX6V3xLoJpIYJ7+vreN\r\nUJCaIbMES5AE1+o5IWgEUZAE+PmNSZCun4NShrgqlTAEtZgs1GUau+g9WxUiOVQJnxRJGuh753Vd\r\n5eU98DEdq5csmQMFn6Qb8jmfVACtGRo5ngMFTgCCRMCh27qfV5MPs5EEAwOklWqj0wkFQXqUVwgE\r\nUlkENHClBkgDGjMFO5ADYKgx1icDVopW4cinOmCcYWmNLMAEOcCbOcsE2McCSmCN3NgDfmgEnnqG\r\nJeACNdAEX7EabDJMMMiSK2cJVVu1OgSDlFC1kyAt2HVqP6WmpTMnWzKiMVeOTLB+O0Bcb\/VbPnAD\r\nvQeVG3MELcADpgmVLdCnKJsDXckEzPj+VlMwnT9LBUAqAxETqUAgA2xpA4a6uNlYpe4pnCwgAzZQ\r\nri5gA5HaBDTLllMKIqiTeBBSe8eoPZjje8e3etfFLrpIXAoLJVAwldPBoWr1Hoiog5ETMjaIOd4q\r\nn3o5BZ\/kNVCbBEcArfL5OUvgBCNoBef6oQh6W0gRIosIsS6pIJLTeyK6IyIKV5FDBVonHeEZOU3w\r\nLpq4i+zCWdKRoZjzjcuXPeH5jZ5zm0QgouM7vkbAUPTyoUFihLWwBG91o\/zjAuWCVhuztg64Ant7\r\nokCZoy2wAktAAzIABAHjfzSwBOHoATmQBDJARpwzBCsQMLlpAz7JA2KZuTXQAxqMkSz+YANJsMLA\r\nGTBDsLgs4AGEGCelMkzAAwls6k0l0ZIK6maNOZLLshuyU7U6uEqYMAU6aAma0mpN8I2m8nTvwYRO\r\nu39O+lvuF5RIkJs84AJQGaTM2MJGGbgkIAM86obh6MDvtwLUV3wkkAOTFAQzMMcz4KT19wNq2Izh\r\nyLPWqKklAIhNgAI9IB7lmAp+2b0Ny0jLpZcJ0jXQhYhJdLrldR3U4TUc6rDToT2VWAmRA67u2zW\/\r\nGx\/3OQVE4Lwf+sSIuAQ68I2QOR8Jo5NCUKHn9S6ZqSD7KVx+GX\/xOB0BuD3bqpfq2b2+l67NKgTX\r\npQTgOgTpCgQaOov7qAOymzkguI\/+ybyqitjJOAV0vqOajMp\/1BiUPEAvFDWQU2AvFbWoSGCUQ2qQ\r\nNZADMSx9XKek9tes07dLYcl7BniFSZgEOvAC26ep1igDTZCNNuCWLJCaMkCqM7mcJQp412W14aUl\r\nBZpdrxN6iLiS9+pKGtkOyjINGz2DxDNShWwFeWuNTAADKZsDg+QCQRoyT6oxPLACA1h9RqmAK\/Cy\r\n71d9SGCW4bgDZrkChJXOlbsCkRNYPasDTHAC2EcyJcADTcACSfADp6pfUBCWMsACJGCohfh0dQUv\r\nRyA+jSBde9kbW\/UuYbpVC2u9kGyD8omID5qwNih7pcEu79Iun3TJFeouZX3KzJv+BJY8okrhHcWn\r\nXopUOkK5ifzontKnid1jBRyrnkBgBFOwXEugfYtjUcV3qKWEBE3grKnJn0MwBR2IiBw4fiAIraVM\r\nBM6KBOmq2pGQqaaDNXKhGz\/AfojjA9PhA8gnSD4QnccHjVjlxbskhTqtgEDQA3UcqkwQSvEzBTrA\r\nfjw5leGMmyEYli7QAz3wgUtgA+fYBKgaBGsZlhnaxSAyE8h2HuQDLzpEFudFkpSmXLr7puEBg+zi\r\ne5IDoc\/7XV5bEuQntldDcbVQtAhMVygqA5FlBTTwxjSQ0vDRzu0cf0vwTOFIpIuqogtzfFXAmydw\r\nhVUwBBdAuVagAy4QBFPQA8X+yYfW6AILUwNUEJbWnLkzwLghLgPlfVuZ5ggoGHBPQH67YBpk4d7S\r\nUSct2cgyGGiYaJKRpMRJfp9NEC1KbAX3WTpO0OSl88RQXF5+iafgsByxzIADMzDl8qRrRQN5xANU\r\nUHy\/VR275Jo3MAREADlWkJs\/MNmw+VawuYmwiYz1rXxwjJ5dwwNG0IEDkwTOQwU\/wNkfqJf\/kgRA\r\nkASz8RKpcB2\/F0pRQkrL177JdXU5gNuTrX92U3w1YCDp3ATgrLlPOgRNADlPsIDL9aSWawP+AgXc\r\naANsWQPBeQROIJepbgOljKqoCiKqgRirMpqNdDkIoj3SIqKUIKAr6Xv0jYP+ONyDfhm7KGGS4YIm\r\n\/OnYQdCwSiKZTc5NA7XVFZIEvXidTzpIQBmUYPWZLmDG96WiNWACJwB7JvBVOQAFK0ACPfAEbnhW\r\ngNUCJCCVTFCFLdC0i7rBSFACJOCyJ\/DBLjACLFACfxiXe1il2YcEJ9BU7KqxTecsuNBpZorjQRh4\r\nJOmX8bBV9wp4IurjWV6Y0UXKRPCwTlA6HMoIXZMgveOlWJEKUAAEPiDmOeC\/QmCNPAADOwAFNIA4\r\nOADBQCC3DdiOnOV5EhJoIoUptGRtjCZUC2YXpeOaPJBHO7J8g118U4CZrllRi7RWxxo\/nzIkHGcm\r\nHwUoppZT0QPgZ+ZdFM3+c7gBdoiJeHK\/agUlukiRKqsidLPxGH7XcOsm9Z5xadmGeWIr+FsePdkW\r\nKN3UcG3Wam3qZxl1b5NSejqfbH9iUJXvbEnH+Z7nJJj0IqiSQRuZSXrW+n8vLLC0cDGCKDVyJKJi\r\nKxFXC+1KKrpWUE5SXTZRW4dfH9vhKyQXIdqM94eGSVlCdamPdjPVKJ9RSbdSUHj1DVbwAzFQBD2w\r\nXiMArqH0r6QSU5U3an4vesCjbZBfC6ckk1V7Ohs5CkYgYAU0AQ5GAs1ETtBTKoBQVWVFSGVlKHh4\r\nKMjDs0JTY+LCozOT07LypLTSxFTzYiOzUkR1UjPjkjrDMnMyNEViuZP+w\/LSZFUlJSWYmzgoaEgl\r\n\/OtbzEuMS1hIOCjM\/PTEpMQUDcW0FM1kNaVNhdSEpFPE5G1khGT+c0Q01EQ1xJQkT3QEhbur23u8\r\nT8zvv39ImKFFihAVUaKkkY8kP2xQeQKDxrR4t5YssYJEybYePGbYmGIlCI8lTLRNITlFHkhduwS1\r\nVDaIWaJk\/ZgpgxlTGZWZigTh8PGDR40dNmy4WGKEBgwXNVyw4EHFRQ8oJXpQgcJxRg0gVojoICGK\r\nCZAVsVigIGKFZa58UHAYiVLF7ZIhUaIwibJzSd0pdoHhFQb3GkgmvMhtKzTwJqEm9m42qzJliqEo\r\nS2KCBAlZGZTIi5X+tWwpKMoQHzyq8BjCA5IMGlqr1HjN48UJJkZOyIBi5HWNEyxcWBkig0cUFCBa\r\n0EhGZceOF6ZR6NARgkWSKC5svLBio7cpHl1BNO1xwkYPoyRZ6FjBokQSKCdIJEmLLzTPmIK4VYli\r\nrwoVuHj17y9UxRJQWLPNZlbEQ80xJd1S0jXgNFHFgBBC0UQTS4BjRSdJLDEFFBsukYR+TDQhTxIg\r\nJUEEZvnsYgQPSPRABBOnCQEJD1Ak1EQjQgzxg4BDGJGEEUMoEYUQFhqhxA+oGaHDEVY8scMTuFRB\r\nAw1E9PDDD0L8gMQRVdgwRA9RkEiEDRVmOGKGjCFBxIVGcGMPN0z+TFHFnGm5FNqII0WBJBJJKIFE\r\ngHPCSAQNPBhBRQ1B\/YADEkvwMAUSQPDAUQ06NNJEEaUBU0QROvTwwiSUQArECzVQYYQNQaDgghGu\r\nWVqFDqfoIIMHLNjgmg5TOLJCPCg4cadaUUzjRBVN1HVsgJI5M2Wd59zSCRT1DZgTM4aAtBMwmDUh\r\nWWcp+SITFRBmqFhjMTWW4S9q7eKEEhs6UcNPryXRyA5APJejjT3UaEVDSEShAySTIjGECzTWQEML\r\nLdDJiA8s1DAEEebNIAMLQySBwSevwfhJrS4EkUoP0s1Agg4syFDDESSwIF0J7t2jzzHDxIRIM3Dt\r\n1BOzhNBJp7T+1nDzBBTRHOPzZnLKw4TPFq0nYRIkztlJJ+KOGDU3SczpIZ0rCuKEW1kOweM7YL6D\r\nqJbWHNoDxHUSIQQUVPCQdAxGWJHExUn4OUS2VSSJRA0M9dDEVD1gSUSQcP3gNA7agMNEDxsa0QM3\r\ntzhZOElHOBlsL3YNCIWj\/yJBMBUkUREPFHyew6U3oFqDg11FRfFCIz9g2cMxLsQQVBAl1CAUFT1c\r\nysPsSzhhAxRL1MBCFDycoINRqpxQgq69\/uCBDGCxcNHWoCnGfTHd4zSlTd3z4nYzJ5pOLiEXIaPI\r\nIe68dyAS3IsrOjPxVdF18F8rqeQQ0v4DwADyw3c2GEF1WOb+AuY1oSnmOMELkhAKU7EgPFA4CxFs\r\nJQNaoEcGMpiBFY7AshO8Z125qEsUpICXukhhPzijSbOO8UIB8sMKw7MCXtxnhQHVBQpOoMK7LCQ1\r\naF1tM0+rkJ1GZKBefOY+TTDCjfRihMropy73GZAUS0i6bDGjLleJULZuJggeocgiR1AHivBjgyX0\r\nAEg\/IALixESENvmpdkd4D4leEakjaAMIaFnXS6BABCPg4AdxgZgb11iFHyjhbYNrhI1cxIRwzC0J\r\nTZlBFED1g9ccgwc4CEIaiQAKG\/DATEYIAhSKEhQb1MAGOojjeFQJOFQ0YQa0hAcHgcAEFtxiiRHC\r\nD2HchR\/+YzntZhbajxeZQIT9VKhCneOhXQRkPItog3zF0g9f7hMFKzgBW\/Zwwv\/cFj4I3SIKILkJ\r\nSAzEDfjExwlLYJQTIJgEHGwIS0DCzZWI8AknLFAKs3sNEQJnHRCh5p4vpIINUGADiaUNeYU7wSSQ\r\nZ4QXhKBVQvmUUVZgBBKgAAUjQEEjVlCCFcigBDLIZR\/XwgvQ8KJZMdyhE7LZH2zeBzDu8KY3\/3eM\r\nE8LFHgLBRYWuYjoqsBMvywQRt4LEmNNIk0IjMtZKtFfF9aTwLyfMofH0A5NkAUMmNqlWs6TAgzIB\r\nkgfyIGscnSCmIABuHT0CJJumkKVKfaNklzuCn44QBPj+4WOvu4gCESi1xhfNLgo9WoILEFem9xwy\r\njfRiCNjyliUm2CBLREipOSo7njbZoLEQnEKZiOAEpvyzB0HQwSxpYIMZNC8JQQCCVlQrgyA8bBBb\r\nq+JmBFIFeXCOi\/dZwn4E1LMLmU4vPHRaDvOyHgjx4gfAehMNfauNvehALze0IS7IqY0DcU8xkZnC\r\nLrfmhEAK8i39UpUR4kgpCPXAblUAkuNQ5Ea0NCGQPBLQVHhQTUGs0ik9WMIJmrAqVsVxoy9AAfKa\r\n4oG8TvAE0ANCE2TQhBysQKQjJcGESeAkXg4Ihd4ck7hM50xzSMFnWhsxfvAz1N6CFi6MSUJ+TWxC\r\nrBr+U286xM9mtkkZBzktJaQjSdIaVKGnovSdbQTteOcLOSL4NaxBKOXsjKDSf7zwhVFIaDZfgIPx\r\nZCisopxbHAv3Zbhc6kUZQsILHMedD+I1YkH4bj7wFLOUohAfO9QpXPjBkvv9QwpLULJfiYADHNxH\r\nrULxMgcoBYpNgao6EUoyPiOjg+qwMgfAguqb9RFlAX7m0scAjacBAsMpteTOnQ4fT2CyXfgoUS1x\r\n3utaOI1STtc203imNZzjLMNkhM8zl\/40VFOKpzfz0tXCbjVK9wFrXyM71HcWn6hf7epjuyTaMaM2\r\nrqWcCFrb2hj9AJeuU03CAIVIe8V+tT+GZwQnOMH+HI97V4RcvO4KDW9Dub3pNrglLRv39Z0XKtad\r\n3eEMIO5sGyYK1opMV9tgL5HWUVxjOly5xsoOsiiT5YEK\/sodIqAgN3Vpygs8JNHKumCjHkABB6pQ\r\nOCuAFHpWYIEGVvBBEvhpBm6OdnzyHOtN3xzXtdXpTlB4H\/xF4aUmvqqN68JOJ\/a5iZCrkNOGRLBr\r\nXMhY\/0paNvNs82kvfOs7x3TCO73nZefaHzLxqqhxzldWo31FW5+2sT8NbFgHW87GBmAMb6J2rAt7\r\n06tm+7Hbzlc5exrnty63DFcKQ9rqvdN6Rzumc+7Hm6dd4dcGtqZnSB9UQ77vJIy83zsv+b9zPe4K\r\nCtcz3SsPakEEAgA7\r\n",
        "geometry": {
          "type": "MultiPoint",
          "coordinates": [
            [
              124.725,
              9.1583333333333
            ],
            [
              124.725,
              9.1583333333333
            ]
          ]
        },
        "names": [
          {
            "namestring": "Mammalia",
            "identifiers": {
              "namebankID": 2478620
            },
            "pages": [
              2853531,
              2853544
            ]
          },
          {
            "namestring": "Apomys insignis",
            "identifiers": {
              "namebankID": 2480867
            },
            "pages": [
              2853531,
              2853534,
              2853535,
              2853536,
              2853537,
              2853538,
              2853539,
              2853540,
              2853541,
              2853542,
              2853543
            ]
          },
          {
            "namestring": "Bullimus gamay",
            "identifiers": {
              "namebankID": 5589461
            },
            "pages": [
              2853531,
              2853532,
              2853543
            ]
          },
          {
            "namestring": "Apomys",
            "identifiers": {
              "namebankID": 2480863
            },
            "pages": [
              2853531,
              2853532,
              2853534,
              2853535,
              2853536,
              2853537,
              2853538,
              2853539,
              2853540,
              2853541,
              2853542,
              2853543,
              2853544
            ]
          },
          {
            "namestring": "Muridae",
            "identifiers": {
              "namebankID": 2480343
            },
            "pages": [
              2853531,
              2853544
            ]
          },
          {
            "namestring": "Rodentia",
            "identifiers": {
              "namebankID": 2476907
            },
            "pages": [
              2853531,
              2853544
            ]
          },
          {
            "namestring": "Apomys hylocoetes",
            "identifiers": {
              "namebankID": 2480866
            },
            "pages": [
              2853532,
              2853534,
              2853535,
              2853536,
              2853537,
              2853538,
              2853539,
              2853540,
              2853541,
              2853542
            ]
          },
          {
            "namestring": "Chrotomys",
            "identifiers": {
              "namebankID": 2480922
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Apomys microdon",
            "identifiers": {
              "namebankID": 2480869
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Rattus",
            "identifiers": {
              "namebankID": 2481308
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Autolytus insignis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Rhynchomys isarogensis",
            "identifiers": {
              "namebankID": 2481368
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Apomys datae",
            "identifiers": {
              "namebankID": 2480865
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Autolytus gracilirostris",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Rhynchomys",
            "identifiers": {
              "namebankID": 2481367
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Chrotomys gonzalesi",
            "identifiers": {
              "namebankID": 2480923
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Autolytus datae",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Autolytus camiguinensis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Autolytus hylocoetes",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Apomys musculus",
            "identifiers": {
              "namebankID": 2480870
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Celaenomys",
            "identifiers": {
              "namebankID": 2480907
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Autolytus musculus",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Apomys camiguinensis",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853534,
              2853535,
              2853536,
              2853537,
              2853538,
              2853540,
              2853541,
              2853542
            ]
          },
          {
            "namestring": "Apomys littoralis",
            "identifiers": {
              "namebankID": 2480868
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Autolytus microdon",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "Apomys gracilirostris",
            "identifiers": {
              "namebankID": 6253589
            },
            "pages": [
              2853534
            ]
          },
          {
            "namestring": "None",
            "identifiers": {
              "namebankID": 0
            },
            "pages": [
              2853542
            ]
          },
          {
            "namestring": "Bullimus",
            "identifiers": {
              "namebankID": 2480893
            },
            "pages": [
              2853544
            ]
          },
          {
            "namestring": "Tarsomys",
            "identifiers": {
              "namebankID": 2481402
            },
            "pages": [
              2853544
            ]
          },
          {
            "namestring": "Murinae",
            "identifiers": {
              "namebankID": 2480810
            },
            "pages": [
              2853544
            ]
          },
          {
            "namestring": "Pteropodidae",
            "identifiers": {
              "namebankID": 2477081
            },
            "pages": [
              2853544
            ]
          },
          {
            "namestring": "Limnomys",
            "identifiers": {
              "namebankID": 2481054
            },
            "pages": [
              2853544
            ]
          },
          {
            "namestring": "Oryx",
            "identifiers": {
              "namebankID": 2478924
            },
            "pages": [
              2853544
            ]
          }
        ]
      }
    }
  }
}
</textarea>


<h3>GET /name/{taxon name}/publications/year/{year}</h3>

<p>Publications tagged with {taxon name} in a {year}</p>

<p><a href="name/Apomys/publications/year/2006" target="_new">name/Apomys/publications/year/2006</a></p>


<h3>GET /name/{taxon name}/suggestions</h3>

<p>For a name {taxon name} return 5 names for which {taxon name} is a substring. Can use for typeahead suggestions.</p>

<p><a href="name/Bufo a/suggestions" target="_new">name/Bufo a/suggestions</a></p>

<textarea readonly="readonly" rows="10" cols="60">
{
  "status": 200,
  "url": "\/_design\/taxonName\/_view\/nameString?startkey=%22Bufo+a%22&endkey=%22Bufo+a%5Cu9999%22&limit=5",
  "suggestions": [
    "Bufo abatus",
    "Bufo abei",
    "Bufo achalensis",
    "Bufo achavali",
    "Bufo acutirostris"
  ]
}</textarea>



<hr />
<h2>Journals</h2>

<p>Get details on an individual journal. Initially assumes we have ISSN for journal, need to handle other ids (e.g., OCLC number) and journals which may lack an external identifier.</p>

<h3>GET /journals/issn/{issn}</h3>

<p>Get details on the journal with the ISSN {issn}. Data from WorldCat.</p>

<p><a href="journals/issn/0022-2933" target="_new">journals/issn/0022-2933</a></p>

<textarea readonly="readonly" rows="10" cols="60">
{
  "_id": "issn\/0022-2933",
  "_rev": "2-fa3a8e2042a01da34302a0f958098b33",
  "rssurl": "http:\/\/www.tandfonline.com\/action\/showFeed?jc=tnah20&type=etoc&feed=rss",
  "publisher": "London, Taylor & Francis",
  "form": "JB",
  "peerreview": "Y",
  "rawcoverage": "v. 1- Jan.\/Mar. 1967-",
  "title": "Journal of natural history",
  "issn": "0022-2933",
  "oclcnum": [
    "642395913",
    "782282274",
    "715060604",
    "615543361",
    "740967792",
    "476154906",
    "263598982",
    "84357648",
    "795770486",
    "137343200",
    "288963957",
    "1783312",
    "788902884",
    "191710334",
    "473991062",
    "474780267",
    "321021698"
  ],
  "issnl": "0022-2933",
  "preceding": [
    "0374-5481"
  ],
  "provenance": [
    {
      "time": "2013-03-06T11:21:06+0000",
      "url": "http:\/\/xissn.worldcat.org\/webservices\/xid\/issn\/0022-2933?method=getHistory&format=json"
    }
  ],
  "status": 200
}
</textarea>


<h3>GET /journals/issn/{issn}/volumes</h3>

<p>Get volumes for a journal, grouped by decade and with article count for each volume. This can be used to provide a JSTOR-like interface where the volumes are clustered by decade, then year, then volume.</p>

<p><a href="journals/issn/1175-5326/volumes" target="_new">journals/issn/1175-5326/volumes</a></p>

<textarea readonly="readonly" rows="10" cols="60">
{
  "status": 200,
  "url": "_design\/issn\/_view\/year?startkey=[\"0022-2933\"]&endkey=[\"0022-2933\",{}]&group_level=4",
  "decades": {
    "1990": {
      "1993": [
        {
          "volume": "27",
          "count": 1
        }
      ]
    },
    "2000": {
      "2007": [
        {
          "volume": "41",
          "count": 1
        }
      ]
    }
  }
}</textarea>


<h3>GET /journals/issn/{issn}/geometry</h3>

<p>Get all point localities in articles in a journal</p>

<p><a href="journals/issn/0006-324X/geometry" target="_new">journals/issn/0006-324X/geometry</a></p>

<textarea readonly="readonly" rows="10" cols="60">
{
  "status": 200,
  "url": "_design\/issn\/_view\/points?key=\"0006-324X\"",
  "coordinates": [
    [
      117.013,
      -19.865
    ],
    [
      118.85666666667,
      -19.495
    ],
    [
      118.87333333333,
      -19.493333333333
    ],
    [
      17.968055555556,
      -33.051944444444
    ],
    [
      18.05,
      -33.116666666667
    ],
    [
      -114.73333333333,
      18.35
    ],
    [
      -109.21666666667,
      10.3
    ],
    [
      -106.55,
      21.583333333333
    ],
    [
      -77.35,
      6
    ],
    [
      -76.783333333333,
      17.95
    ],
    [
      -73.75,
      -39.75
    ],
    [
      -70.75,
      -33.75
    ],
    [
      -70.347333333333,
      40.049333333333
    ],
    [
      -70.0965,
      40.015166666667
    ],
    [
      -42.983333333333,
      -22.433333333333
    ],
    [
      -84.833333333333,
      10.483333333333
    ],
    [
      -128.98333333333,
      45.933333333333
    ],
    [
      -86.225,
      0.80333333333333
    ],
    [
      -86.153333333333,
      0.79833333333333
    ],
    [
      -86.128333333333,
      0.795
    ],
    [
      -86.083333333333,
      0.58333333333333
    ],
    [
      114.11666666667,
      -6.0833333333333
    ],
    [
      146.61666666667,
      -19.15
    ],
    [
      -156.18333333333,
      21.15
    ],
    [
      -156.13333333333,
      21.016666666667
    ],
    [
      -96.45,
      25.083333333333
    ],
    [
      -88.333333333333,
      29.05
    ],
    [
      -88.1,
      29.1
    ],
    [
      -87.8,
      29.2
    ],
    [
      -87.108333333333,
      29.866666666667
    ],
    [
      -86.45,
      28.55
    ],
    [
      -83.6,
      24.35
    ],
    [
      -83.516666666667,
      24.433333333333
    ],
    [
      -81.7,
      24.166666666667
    ],
    [
      -80.05,
      29.666666666667
    ],
    [
      -80,
      24.4
    ],
    [
      -79.8,
      28.7
    ],
    [
      -79.716666666667,
      23.983333333333
    ],
    [
      -79.666666666667,
      23.416666666667
    ],
    [
      -79.616666666667,
      23.091666666667
    ],
    [
      -79.583333333333,
      23.166666666667
    ],
    [
      -79.35,
      25.6
    ],
    [
      -79.3,
      23.666666666667
    ],
    [
      -79.283333333333,
      23.983333333333
    ],
    [
      -79.283333333333,
      24.8
    ],
    [
      -79.266666666667,
      22.916666666667
    ],
    [
      -79.166666666667,
      23.266666666667
    ],
    [
      -78.833333333333,
      22.8
    ],
    [
      -78.568333333333,
      26.116666666667
    ],
    [
      -76.883333333333,
      8.9333333333333
    ],
    [
      -67.933333333333,
      10.7
    ],
    [
      -66.296666666667,
      10.911666666667
    ],
    [
      -61.883333333333,
      16.883333333333
    ],
    [
      -54.6,
      7.7666666666667
    ],
    [
      -53.066666666667,
      7.3333333333333
    ],
    [
      -52.916666666667,
      7.1666666666667
    ],
    [
      -15.033333333333,
      -33.516666666667
    ],
    [
      -9.4333333333333,
      4.3333333333333
    ],
    [
      -5.0166666666667,
      4.9333333333333
    ],
    [
      8.05,
      3.75
    ],
    [
      8.7833333333333,
      -2
    ],
    [
      11.016666666667,
      -4.6333333333333
    ],
    [
      33.583333333333,
      -25.483333333333
    ],
    [
      76.908333333333,
      7.2916666666667
    ],
    [
      120.03,
      13.82
    ],
    [
      120.04166666667,
      13.803333333333
    ],
    [
      120.46666666667,
      13.841666666667
    ],
    [
      120.49166666667,
      13.781666666667
    ],
    [
      120.49666666667,
      13.77
    ],
    [
      123.35416666667,
      9.2791666666667
    ],
    [
      132.38333333333,
      32.6
    ],
    [
      135.55,
      35.429166666667
    ],
    [
      135.56666666667,
      33.391666666667
    ],
    [
      138.66388888889,
      33.091666666667
    ],
    [
      139.46666666667,
      35.183333333333
    ],
    [
      150.38333333333,
      -43.95
    ],
    [
      150.63333333333,
      -35.733333333333
    ],
    [
      152,
      -33.533333333333
    ],
    [
      153.68333333333,
      -29.916666666667
    ],
    [
      153.7,
      -29.866666666667
    ],
    [
      42.766666666667,
      41.4
    ],
    [
      -75.643333333333,
      19.913333333333
    ],
    [
      -74.233333333333,
      34
    ],
    [
      -74.215,
      33.988333333333
    ],
    [
      -44.826666666667,
      26.138333333333
    ],
    [
      -86.566666666667,
      20.95
    ],
    [
      -80.994444444444,
      24.238888888889
    ],
    [
      -80.579166666667,
      24.801388888889
    ],
    [
      -79.716666666667,
      26.266666666667
    ],
    [
      -79.010833333333,
      31.288333333333
    ],
    [
      -78.666666666667,
      26.45
    ],
    [
      -77.863888888889,
      31.813888888889
    ],
    [
      100.86666666667,
      12.666666666667
    ],
    [
      134.25416666667,
      7.0958333333333
    ],
    [
      134.25416666667,
      7.0958333333333
    ],
    [
      134.25416666667,
      7.0958333333333
    ],
    [
      -89.65,
      -1.3666666666667
    ],
    [
      -79.466666666667,
      -9.4
    ],
    [
      -79.213333333333,
      8.005
    ],
    [
      -79.196666666667,
      8.0116666666667
    ],
    [
      -78.571666666667,
      9.5416666666667
    ],
    [
      -78.558333333333,
      9.535
    ],
    [
      -78.433333333333,
      9.5116666666667
    ],
    [
      -78.426666666667,
      9.5083333333333
    ],
    [
      -78.361666666667,
      9.4866666666667
    ],
    [
      -78.345,
      9.4716666666667
    ],
    [
      -78.271666666667,
      9.4433333333333
    ],
    [
      -76.191666666667,
      34.115
    ],
    [
      -69.368333333333,
      11.66
    ],
    [
      -69.333333333333,
      11.7
    ],
    [
      -66.35,
      10.708333333333
    ],
    [
      -66.34,
      10.733333333333
    ],
    [
      -66.3,
      10.96
    ],
    [
      -66.296666666667,
      10.911666666667
    ],
    [
      -65.033333333333,
      10.333333333333
    ],
    [
      -64.266666666667,
      10.725
    ],
    [
      -63.216666666667,
      10.8
    ],
    [
      -63.216666666667,
      10.833333333333
    ],
    [
      -62.933333333333,
      10.793333333333
    ],
    [
      -62.916666666667,
      10.79
    ],
    [
      -62,
      10.75
    ],
    [
      -48.566666666667,
      -30.183333333333
    ],
    [
      -40.366666666667,
      -2.5166666666667
    ],
    [
      117.18333333333,
      -20.016666666667
    ],
    [
      118.1,
      -19.633333333333
    ],
    [
      142.58333333333,
      -38.636666666667
    ],
    [
      143.4,
      -39.816666666667
    ],
    [
      143.92666666667,
      -39.226666666667
    ],
    [
      144.34833333333,
      -40
    ],
    [
      -73.393611111111,
      -38.035277777778
    ],
    [
      -73.380277777778,
      -37.735833333333
    ],
    [
      -73.255,
      -37.926944444444
    ]
  ]
}</textarea>


<h3>GET /journals/issn/{issn}/volumes/{volume}/year/{year}</h3>

<p>Get articles for a given volume in a given year. Can use this as part of a display of journal articles.</p>



<!--
<h3>GET /journals/issn/{issn}/volumes/{volume}/year/{year}</h3>

<p>Get articles for a given volume in a given year. Use this to as part of a display of journal articles.</p>

<textarea readonly="readonly" rows="10" cols="60">
</textarea>
-->

<h3>GET /journals/issn/{issn}/articles/identifiers</h3>

<p>Get identifiers for all articles in a journal. List grouped by year. Useful if you want to display identifier coverage.</p>

<p><a href="journals/issn/1808-9798/articles/identifiers" target="_new">journals/issn/1808-9798/articles/identifiers</a></p>


<textarea readonly="readonly" rows="10" cols="60">
{
  "status": 200,
  "url": "_design\/issn\/_view\/identifier?startkey=[\"1808-9798\"]&endkey=[\"1808-9798\",{}]",
  "years": {
    "2006": {
      "2839263f5d62ac1fafc6bd3ab859fa12": [
        "doi"
      ]
    },
    "2007": {
      "2ac0b963f8c997cf9fc4815050493b36": [
        "doi"
      ],
      "5ea3f1b8d404a7c37dafe9d1b5398b03": [
        "doi"
      ],
      "8a00a0399ecb33637b02c9ea4b246dc6": [
        "doi"
      ]
    },
    "2008": {
      "5427f2f2ea63d6dc3097d5c5f32b4dbc": [
        "doi"
      ],
      "a0831c816db5a50260e43e169f2a4875": [
        "doi"
      ],
      "c063e8123d559825c71d3ddfb0fa7d89": [
        "doi"
      ],
      "d79577cd7ac2d6b1f95a594684e41fc1": [
        "doi"
      ]
    }
  }
}
</textarea>

<hr />
<h2>Author</h2>

[basically a search by author name]

/authors/

<h3>GET /authors/lastname/{lastname}</h3>

<p>Return a list of author names that share the same surname</p>

[do we want to offer to cluster these?]

<p><a href="authors/lastname/Smith" target="_new">authors/lastname/Smith</a></p>

<textarea readonly="readonly" rows="10" cols="60">
{
  "status": 200,
  "url": "_design\/author\/_view\/lastname_firstname?startkey=%5B%22Smith%22%5D&endkey=%5B%22Smith%22%2C%22%5Cu9999%22%5D&group_level=2",
  "firstnames": [
    "E N",
    "Eric N",
    "H M",
    "Hobart M",
    "L M",
    "M L",
    "Malcolm",
    "Malcolm A",
    "Philip W",
    "S G",
    "W Leo"
  ]
}
</textarea>

<h3>GET /authors/{name}/coauthors</h3>

<p>Return a list of coauthors</p>



<p><a href="authors/R B Manning/coauthors" target="_new">authors/R B Manning/coauthors</a></p>

<textarea readonly="readonly" rows="10" cols="60">
{
  "status": 200,
  "url": "_design\/author\/_view\/coauthor?startkey=%5B%22R+B+Manning%22%5D&endkey=%5B%22R+B+Manning%22%2C%7B%7D%5D&group_level=2",
  "coauthors": [
    "A Tamaki",
    "A Y Tai",
    "B Holthuis L",
    "C W Hart",
    "D K Camp",
    "D L Felder",
    "E W Dawson",
    "H C Ghosh",
    "L B Holthuis",
    "M L Reaka",
    "M V Erdmann",
    "P K L Ng",
    "R G Garcia",
    "R W Heard",
    "W R Webber"
  ]
}
</textarea>

<h3>GET /authors/{name}/publications</h3>

<p>Return a list of publications by author</p>


<p><a href="authors/A A Giaretta/publications" target="_new">authors/A A Giaretta/publications</a></p>

<textarea readonly="readonly" rows="10" cols="60">
{
  "status": 200,
  "publications": [
    {
    ...
    },
    {
    ...
   }
   ]
}
</textarea>


<hr />
<h2>Timeline</h2>




<hr />
<h2>Search</h2>

rdmpage.cloudant.com/bionames/_design/citation/_search/all?q=frog species&include_docs=true


<hr />
<h2>OpenURL</h2>

<hr />
<h2>Darwin Core</h2>



</body>
</html>