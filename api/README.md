tworzenie admina:
	php app/console fos:user:create admin --super-admin

register:
	/register
	
	{
		"username":"test2",
		"email":"test@mail.com",
		"password":"123admin"
	}

login:
	/oauth/v2/token

	client_id:1_1f89qgisf6pwo8cc4s40sogcw0csk4oogsk0w08gkgcwg4s8ks
	client_secret:64qgef5al1gksosg4og80w0w0wkcscsogs44sgcokk0sc08kc4
	grant_type:password
	username:gwym
	password:123admin

refresh:
	/oauth/v2/token

	client_id:1_1f89qgisf6pwo8cc4s40sogcw0csk4oogsk0w08gkgcwg4s8ks
	client_secret:64qgef5al1gksosg4og80w0w0wkcscsogs44sgcokk0sc08kc4
	grant_type:refresh_token
	refresh_token:[token_to_refresh]


do requestów:
	access_token:[token]