FROM grafana/grafana:latest
RUN apk --no-cache add git
RUN git clone git@github.com:weidedouglas/Monitoramento-web-HLG.git
RUN cd ./grafana/provisioning && git checkout master
RUN chown -R grafana:grafana ./grafana/provisioning
