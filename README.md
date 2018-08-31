## Webhook echo
A simple app to receive request from webhooks.
You can use any http method to do test; GET, POST, PUT, OPTION or DELETE.
For each valid request, a JSON file (named `request_id.json`)  will be created on dir `/doc`,
these files can be seen directly from browser to check the webhook request content.

## Deploy to:
[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/ecomclub/wh-echo)

## Using
After deploying on heroku or any host, you have to set APP_TOKEN on your `.env` file.
This token must be on URL of every request.

### Endpoint

When you finish deploy you will be able to make request on endpoint:

`http://my-webhook-echo.herokuapp.com/wh/{token}/{request_id}/{any_content}`

```
{
	"headers": {
		"CONTENT_LENGTH": [
			"0"
		],
		"HTTP_TOTAL_ROUTE_TIME": [
			"0"
		],
		"HTTP_X_REQUEST_START": [
			"1535655005549"
		],
		"HTTP_CONNECT_TIME": [
			"1"
		],
		"HTTP_VIA": [
			"1.1 vegur"
		],
		"HTTP_X_FORWARDED_PORT": [
			"443"
		],
		"HTTP_X_FORWARDED_PROTO": [
			"https"
		],
		"HTTP_X_FORWARDED_FOR": [
			"179.179.227.43"
		],
		"HTTP_X_REQUEST_ID": [
			"7669346f-f9f2-4d70-9840-486822d8f59e"
		],
		"HTTP_ACCEPT": [
			"*\/*"
		],
		"HTTP_COOKIE": [
			"PHPSESSID=6a7f8f941b70fd8c6a5a60fdf2ce3f92"
		],
		"HTTP_USER_AGENT": [
			"insomnia\/6.0.2"
		],
		"HTTP_CONNECTION": [
			"close"
		],
		"HTTP_HOST": [
			"my-webhook-echo.herokuapp.com"
		]
	},
	"body": {
        "var1": "content var1",
        "var2": "content var2"
    },
	"id": "request_id",
	"content": "anything",
	"path": "request_id\/anything"
}
```
