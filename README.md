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
- The term _Cold starts_ refers to the moment when there is no containers available because all of them have been garbage collected and there will be a delay to instantiate a new one

We can find different Serverless providers:

- Amazon
- Google Cloud Functions
- Microsoft
- IBM

There are probably many other that I do not know about...

The problem with many of these providers is that they do not support all the available languages, for example, PHP is not fully supported of most of them. But the good news is that a while ago, AWS opened the API to allow the community to add support for new languages, and that's what Bref is here for!

### Bref

I will not waste much time introducing Bref, if you want to know more about is better to refer directly to the [documentation](https://bref.sh/docs/).

An important thing to talk about is that Bref uses the [serverless framework](https://serverless.com/) to handle the deployment of the Lambdas. We will only need to define our configuration in a Yaml file and use the provide cli utility to deploy it.

Bref also provides a _Dockerized_ environment for local development. This is what we will use for our little demo.
