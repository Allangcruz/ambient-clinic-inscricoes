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
	@if [ -z "ambientclinic" ]; then \
		echo "Erro: A variável de ambiente DEPLOY_USERNAME não está definida." >&2; \
		exit 1; \
	fi
	@if [ -z "89.117.32.89" ]; then \
		echo "Erro: A variável de ambiente DEPLOY_ADDRESS_IP não está definida." >&2; \
		exit 1; \
	fi
	@if [ -z "$(DEPLOY_PATH)" ]; then \
		echo "Erro: A variável de ambiente DEPLOY_PATH não está definida." >&2; \
		exit 1; \
	fi
	
	@echo "Inicializando Rsync"
	rsync -avzP -e "ssh -i ~/.ssh/ambientclinic" deploy.zip ambientclinic@89.117.32.89:$(DEPLOY_PATH) \
		--recursive \
		--checksum \
		--verbose
	@echo "Finalizando Rsync"

config:
	ssh -t -v -i ~/.ssh/ambientclinic ambientclinic@89.117.32.89 ' \
	cd "$(DEPLOY_PATH)" && \
	cp "$(DEPLOY_PATH)"/../.env "$(DEPLOY_PATH)"/.env && \
	unzip -o -q deploy.zip '
