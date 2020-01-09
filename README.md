# PHP on AWS Lambda

The goal of this repository is to introduce [Bref](https://bref.sh/), a project that allow to easily run PHP code on AWS Lambda.

## Introduction

Bref was introduced to me in one of the talks of the [PHP.Barcelona](https://php.barcelona/) conference. But before getting started with it, let's talk a little bit about Serverless.

**Note:** Keep in mind that most of the content of this README comes from the notes I took in the conference, so its not the absolute truth but it can serve as an starting point.

### Serverless

As I understand it, we can talk about Serverless as a FaaS (Function as a service).

Some characteristics:

- Serverless does not only works for HTTP, also for workers ans other protocols
- Each request is handled by an individual container, isolated from the other requests
- One container can handle one request at a time
- After some time the container is garbage collected
- We only pay for the time the code is running, the garbage collection is not part of this time
- The term _Cold starts_ refers to the moment when there are no containers available because all of them have been garbage collected and there will be a delay to instantiate a new one

We can find different Serverless providers:

- Amazon
- Google Cloud Functions
- Microsoft
- IBM

There are probably many other that I do not know about...

The problem with many of these providers is that they do not support all the available languages, for example, PHP is not fully supported of most of them. But the good news is that a while ago, AWS opened the API to allow the community to add support for new languages, and that's what Bref is here for!

### Bref

I will not waste much time introducing Bref, if you want to know more about is better to refer directly to the [documentation](https://bref.sh/docs/).

One important thing to notice is that Bref brings us three different environments for our PHP Lambdas:

1. PHP functions
2. HTTP APIs
3. Console commands

For the demo, we are going to use the second one.

Another important thing to talk about is that Bref uses the [serverless framework](https://serverless.com/) to handle the deployment of the Lambdas. We will only need to define our configuration in a Yaml file and use the provide cli utility to deploy it.

Finally, Bref also provides a _Dockerized_ environment for quickly local development. We will use it for the demo.

## Demo

To play a little bit with Bref, we are going to implement a simple carrier integration for our local environments.

To get started, clone this repository into your project's folder and run the command `composer install`. If you check the `composer.json` file, you will see that we only installed two dependencies:

1. Bref itself
2. Slim (a simple framework to implement the HTTP API of the Lambda)

### Bref local development

First of all, we are going to use the local development tools that Bref gives to us. Basically, it consists in a _Dockerized_ environment to simulate that our code is running inside an AWS Lambda container. If you want to read more about it you can check the [docs](https://bref.sh/docs/local-development.html).

I've prepared a simple Makefile to start and stop the application so you can use the command `make run` to start both services defined in the docker-compose file. At this point, the Lambda should be listening on the port 8000 of your local host.

Now we should be able to register this Lambda on the service bus. In my case, I've used the following message:

```json
{
    "jsonrpc":"2.0",
    "method": "magento.service_bus.remote.register",
    "id": 1,
    "params":
    {
       "id": "carrier_mock",
       "url": "http://10.0.2.2:8000/api",
        "subscribes": [
            "magento.logistics.carrier_management.request_shipping_details"
        ]
    }
}
```

**Note:** The IP address 1.0.2.2 is the one used by my VM to contact the Host.

If you want to try it, open a pick list and try to confirm packing a line. To debug the requests made to the Lambda, we can use the `docker-compose logs -f` command.

### Bref deployment to AWS

TODO
