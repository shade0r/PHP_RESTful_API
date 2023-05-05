I built this API while I was learning REST principels.


### RESTful API Design Principles

1. **Client-server architecture:** A RESTful API should separate the client and server components of the application, allowing them to evolve independently.

2. **Uniform interface:** A RESTful API should have a uniform and consistent interface that is easy to understand and use. The interface should provide resources that can be identified by URIs, and actions that can be performed on those resources using HTTP verbs (GET, POST, PUT, DELETE).

3. **Stateless communication:** A RESTful API should be stateless, meaning that each request should contain all the information necessary to complete the request. The server should not store any client context between requests.

4. **Cacheability:** A RESTful API should be designed to be cacheable, which can improve performance and reduce server load. Responses should include caching headers that indicate how long the response can be cached.

5. **Layered architecture:** A RESTful API should be designed to support a layered system architecture, where the client interacts with a server that may interact with other servers or data sources.

6. **Code on demand (optional):** A RESTful API may optionally allow clients to execute code on the server, such as JavaScript or Java applets, to extend the functionality of the client.

To design a RESTful API, you should follow these principles and use HTTP as the underlying protocol. This means that you should use HTTP verbs to define the actions that can be performed on resources, and use HTTP status codes to indicate the success or failure of each request.

You should also design your API to be easily discoverable and self-describing, using tools like OpenAPI or Swagger to provide documentation and examples of how to use the API.

Overall, designing a RESTful API requires careful consideration of the principles of REST, as well as the needs of the application and the users who will be using the API. By following these principles, you can create an API that is easy to use, scalable, and maintainable.

## Autherization
for Authorization I added a simple method that takes (Authorization: token_value) as a request header and compares the token values to pre-set tokens I set before in the database tokens table (You can set your own) and if this token is valid then you can use the api else you are not authorized to use it
