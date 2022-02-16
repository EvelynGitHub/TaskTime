# Documentando a estrutura do Backend do Projeto

## Cada pasta Representa uma Entidade da Aplicação

Mesmo que uma entidade denpenda de outra, componha ou extenda de outra, cada uma deve ficar dentro de sua respectiva pasta.

## Fluxo da Aplicação dentro da pasta que representa a Entidade

### Controller
Responsável por receber a requisição bruta do cliente, formatar a entrada de dados e passar a mesma para o **UseCase** correspondende. Além disso também é reponsável por receber a resposta do **UseCase** e devolver ao cliente a responsa (saída) apropriada.

### 
