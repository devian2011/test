
.PHONY: prepare_test_db
prepare_test_db:
	./bin/console --env=test doctrine:database:drop
	./bin/console --env=test doctrine:database:create
	./bin/console --env=test doctrine:migrations:migrate

.PHONY: test
test: prepare_test_db
	./bin/phpunit
