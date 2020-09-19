#!/bin/bash

for file in ./deployment/kubernetes/* ; do
    kubectl apply -f "$file"
done

