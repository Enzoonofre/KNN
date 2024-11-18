import numpy as np
import matplotlib.pyplot as plt


def KNN(pontos, novo_ponto):
    distancias = []
    for ponto in pontos:
        # Vai calcular a distancia euclidiana
        distancia = np.sqrt((ponto[0] - novo_ponto[0]) ** 2 + (ponto[1] - novo_ponto[1]) ** 2)
        distancias.append(distancia)
    return distancias


def atribuir_target(k, dict_pontos_target, novo_ponto):
    # Obter todas as distâncias
    distancias = KNN([list(ponto) for ponto in dict_pontos_target.keys()], novo_ponto)

    # Criar uma lista de tuplas (distancia, target) e ordenar por distância
    pontos_distancias = sorted(zip(distancias, dict_pontos_target.keys()), key=lambda x: x[0])

    # Contar os targets dos k pontos mais próximos
    contagem_target = {0: 0, 1: 0}
    for _, ponto in pontos_distancias[:k]:
        target = dict_pontos_target[ponto]['target']
        if target is not None:  # Ignorar pontos com target None
            contagem_target[target] += 1

    # Atribuir o novo target com base na maioria
    novo_target = 1 if contagem_target[1] > contagem_target[0] else 0
    return novo_target



# Matriz de pontos e target
pontos = [[8, 6], [6, 1], [5, 0], [1, 5], [7, 7], [9, 8], [4, 1], [2, 8], [5, 1], [3, 4]]
target = [1, 0, 1, 0, 1, 0, 0, 0, 1, 1]
np.random.shuffle(target)

# Criando um dicionário que mapeia cada ponto ao seu respectivo target
dict_pontos_target = {tuple(ponto): {'target': target[i], 'distancia': None} for i, ponto in enumerate(pontos)}


print("Dicionário de pontos e targets:", dict_pontos_target)

# Criando o gráfico inicial
plt.figure(figsize=(6, 6))

# Colorindo o ponto de acordo com o target
for i in range(len(pontos)):
    if target[i] == 0:
        plt.scatter(pontos[i][0], pontos[i][1], color='blue', label='Target 0' if i == 0 else "")
    else:
        plt.scatter(pontos[i][0], pontos[i][1], color='red', label='Target 1' if i == 4 else "")


plt.title("Gráfico de Pontos com Targets 0 e 1")
plt.xlabel("Eixo X")
plt.ylabel("Eixo Y")
plt.legend()
plt.grid(True)


plt.show()

# Solicitando ao usuário para informar dois números para um novo ponto
x = float(input("Informe o valor do eixo X para o novo ponto: "))
y = float(input("Informe o valor do eixo Y para o novo ponto: "))
novo_ponto = [x, y]

# Atualizando a lista de pontos com o novo ponto
pontos.append(novo_ponto)

# Atualizando o target do novo ponto para None e adicionando ao dicionário
dict_pontos_target[tuple(novo_ponto)] = {'target': None, 'distancia': None}

# Criando o gráfico novamente para incluir o novo ponto
plt.figure(figsize=(6, 6))

# Plotando os pontos existentes
for i in range(len(pontos) - 1):  # Não inclui o novo ponto na plotagem anterior
    if target[i] == 0:
        plt.scatter(pontos[i][0], pontos[i][1], color='blue', label='Target 0' if i == 0 else "")
    else:
        plt.scatter(pontos[i][0], pontos[i][1], color='red', label='Target 1' if i == 4 else "")

# Cor roxa para o novo ponto
plt.scatter(novo_ponto[0], novo_ponto[1], color='purple', label='Novo Ponto (sem target)')


plt.title("Gráfico de Pontos com Targets 0 e 1 + Novo Ponto")
plt.xlabel("Eixo X")
plt.ylabel("Eixo Y")
plt.legend()
plt.grid(True)


plt.show()

# Calculando as distâncias euclidianas do novo ponto para todos os pontos existentes
distancias = KNN(pontos[:-1], novo_ponto)  # Exclui o novo ponto da lista

# Atualizando o dicionário com as distâncias
for i, ponto in enumerate(pontos[:-1]):  # Exclui o novo ponto
    dict_pontos_target[tuple(ponto)]['distancia'] = distancias[i]


k = int(input("Informe o valor de k para determinar o novo target: "))

# Atribuindo o novo target com base nos k pontos mais próximos
novo_target = atribuir_target(k, dict_pontos_target, novo_ponto)
dict_pontos_target[tuple(novo_ponto)]['target'] = novo_target

# Exibindo o dicionário atualizado com as distâncias e o novo target
print("Dicionário de pontos e targets atualizado:", dict_pontos_target)

# Criando um gráfico para mostrar o novo target
plt.figure(figsize=(6, 6))

# Plotando os pontos existentes
for ponto, info in dict_pontos_target.items():
    if info['target'] == 0:
        plt.scatter(ponto[0], ponto[1], color='blue',
                    label='Target 0' if 'Target 0' not in plt.gca().get_legend_handles_labels()[1] else "")
    elif info['target'] == 1:
        plt.scatter(ponto[0], ponto[1], color='red',
                    label='Target 1' if 'Target 1' not in plt.gca().get_legend_handles_labels()[1] else "")
    if ponto == tuple(novo_ponto):
        plt.scatter(ponto[0], ponto[1], color='purple', label='Novo Ponto (target: {})'.format(novo_target))

# Configurando os detalhes do gráfico
plt.title("Gráfico de Pontos com Novo Target Atribuído")
plt.xlabel("Eixo X")
plt.ylabel("Eixo Y")
plt.legend()
plt.grid(True)

# Exibindo o gráfico atualizado
plt.show()

# Exibindo o novo target do novo ponto
print(f"O novo ponto tem o target igual a: {novo_target}")
