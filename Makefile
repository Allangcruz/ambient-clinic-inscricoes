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
	@if [ -z "$(DEPLOY_USERNAME)" ]; then \
		echo "Erro: A variável de ambiente DEPLOY_USERNAME não está definida." >&2; \
		exit 1; \
	fi
	@if [ -z "$(DEPLOY_ADDRESS_IP)" ]; then \
		echo "Erro: A variável de ambiente DEPLOY_ADDRESS_IP não está definida." >&2; \
		exit 1; \
	fi
	@if [ -z "$(DEPLOY_PATH)" ]; then \
		echo "Erro: A variável de ambiente DEPLOY_PATH não está definida." >&2; \
		exit 1; \
	fi
	
	@echo "Inicializando Rsync"
	rsync -avzP deploy.zip $(DEPLOY_USERNAME)@$(DEPLOY_ADDRESS_IP):$(DEPLOY_PATH) \
		--recursive \
		--checksum \
		--verbose
	@echo "Finalizando Rsync"

config:
	ssh -t "$(DEPLOY_USERNAME)"@"$(DEPLOY_ADDRESS_IP)" ' \
	cd "$(DEPLOY_PATH)" && \
	cp "$(DEPLOY_PATH)"/../.env "$(DEPLOY_PATH)"/.env && \
	unzip -o -q deploy.zip '
