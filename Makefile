compactar:
	zip -q -m -r -T deploy.zip \
	app \
	public \
	vendor \
	writable \
	composer.json \
	composer.lock \
	preload.php \
	spark 

deploy:
	@if [ -z "$(DEPLOY_PATH)" ]; then \
		echo "Erro: A variável de ambiente DEPLOY_PATH não está definida." >&2; \
		exit 1; \
	fi
	
	@echo "Inicializando Rsync"
	rsync -avzP deploy.zip ambientclinic@servidor.ambientclinic:$(DEPLOY_PATH) \
		--recursive \
		--checksum \
		--verbose
	@echo "Finalizando Rsync"

config:
	ssh -t -v ambientclinic@servidor.ambientclinic ' \
	cd "$(DEPLOY_PATH)" && \
	cp "$(DEPLOY_PATH)"/../.env "$(DEPLOY_PATH)"/.env && \
	sudo rm -rf app public vendor writable && \
	unzip -o -q deploy.zip  && \
	pwd && \
	ls -lha && \
	sudo chown -R www-data:www-data $(DEPLOY_PATH)/writable && \
	ls -lha '
