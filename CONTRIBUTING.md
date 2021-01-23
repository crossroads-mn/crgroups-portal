# Contributing
The contributing docs are still a work in progress.  However, if you are familiar with Docker, you should be able to use the provided `docker-compose` to create a working local dev environment.

## Docker Dev Setup
Credit to https://www.pascallandau.com/blog/php-php-fpm-and-nginx-on-docker-in-windows-10/ for the instructions to work from

Create an `.env` environment file (use `.env.example` as a template).  Set the `MYSQL_CONN_STRING` value accordingly.

Startup the app and nginx containers with a docker shared network
```
docker-compose up
```

Verify the app if working at http://localhost:8080

## Teardown

```
docker-compose down
```

## Production Local Kubernetes Deployment
> These Production notes are still a work in progress.  Production deployments of this app are still hosted in Azure App Service instances.

Use `prod-k8s-local.sh` to build prod-like containers and deploy onto Kubernetes

```
prod-k8s-local.sh
```

### Troubleshooting
Validate that the k8s service `crgroups-client` has an External IP and Endpoints being serviced

```
$ kubectl describe service crgroups-client
Name:                     crgroups-client
Namespace:                default
Labels:                   <none>
Annotations:              Selector:  app=crgroups-client
Type:                     LoadBalancer
IP:                       10.96.49.253
LoadBalancer Ingress:     localhost          <--- valid loadbalancer host
Port:                     http  8080/TCP
TargetPort:               80/TCP
NodePort:                 http  32659/TCP
Endpoints:                10.1.0.36:80   <--- valid pod endpoint
Session Affinity:         None
External Traffic Policy:  Cluster
Events:                   <none>
```