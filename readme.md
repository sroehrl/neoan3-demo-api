# neoan3 PHP api demo

Quick & dirty api scaffolding as a result of a [twitch.tv/neoan3](https://twitch.tv/neoan3) session

## Installation

**NOTE:** requires [neoan3-cli](https://github.com/neoan3/cli)
to be globally available. 

1. Clone this repo
2. `composer update`
3. `neoan3 develop`

That's it, your project should run.

## Usage
Within the project directory, run

`php scaffold <yourAPIendpointName>` to generate get & post endpoints.

Modifications (or additional methods) to the endpoint can be achieved by editing the generated model & component files.
Look into [neoan3](https://neoan3.rocks) for specifics.

## user model

This project already ships with a user model & endpoints.

_To register_

**POST /api.v1/users**

```json
{
  "userName": "name82",
  "password": "123456",
  ... // you can add whatever properties you like
}
```
_response format:_
```json
{
  "user": {
    "userName": "name82",
    "_id": "id-with-high-entropy"
  },
  "token": "JWT-token"
}
```

All generated calls require a JWT-token to be used.

```javascript
// e.g. axios
const config = {
    headers: { Authorization: `Bearer ${token}` }
};

axios.get('http://localhost:8080/api.v1/test/1',{},config).then(...)
```
_to login_

**POST /api.v1/users/auth**

expects same json-format (userName, password) as register, returns same format.

### Examples

`php scaffold posts`

Generates the following endpoints:

**POST /api.v1/posts** creates new post

**GET /api.v1/posts** returns multiple posts; accepts optional parameters (e.g. ?title=first)

**GET /api.v1/posts/:id** retrieves a post

**PUT /api.v1/posts/:id** updates a post

```javascript
// e.g. axios
const config = {
    headers: { Authorization: `Bearer ${token}` }
};
const endpoint = "http://localhost:8080/api.v1/posts";

// create post
axios.post(endpoint, {
    title: "my first post",
    content: "What a day!",
    gitHubLink: "https://github.com/sroehrl",
    author: "neoan"
},config).then(res => {
    const post = res.data;
    
    // get all posts by neoan
    axios.get(endpoint + '?author=neoan',{},config).then(res => {
        const allPosts = res.data;    
    })
})
```

## The big picture

Instead of generating a pure test-api, the setup is meant to upcycle,
meaning the structure is solid. You can build out actual database implementation while providing immediate usability. 