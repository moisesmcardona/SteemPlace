from piston.account import Account
from piston.steem import Steem
import sys

node = Steem(node="wss://node.steem.place")
account = Account(sys.argv[1], node)
checkSteemPlace=account["posting"]["account_auths"]
isAuthorized = False
for item in checkSteemPlace:
	if "steem.place" in item:
		isAuthorized = True
print(isAuthorized)