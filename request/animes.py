#Script para consumir API
#Linguagem utilizada : Python3
#Created by Jhonatas Rodrigues
#

import requests
import json
import os

# Request Area
# Menu Area
os.system('clear')
print("--> Bem vindo ao apipy 1.0 <--")
def menu(first=False):
        if not first:
            print("pressione qualquer tecla ...")
            input()
            os.system('clear')
        print( "(Menu)")
        print( ">> Use (1) Para Ver anime")
        print( ">> Use (2) Para Inserir anime")
        print( ">> Use (3) Para Atualizar anime")
        print( ">> Use (4) Para Deletar anime")
        print( ">> Use (0) Para Abortar :/")
        valor = input('Resposta :')
        if valor == '1':
            os.system('clear')
            print("loading...")
            data = requests.get('http://localhost:8000/api/anime')
            binary = data.content
            output = json.loads(binary)
            os.system('clear')
            x = 0
            print("-----anime{s} encontrado{s}-----\n".format(s='s' if len(output['data']) > 1 else ''))
            for item in output['data']:
                print('>> Id:',item['id'],'\n>> Nome: ', item['name'], '\n>> Gênero :', item['genero'], '\n>> idade_indicativa :', item['idade_indicativa'], '\n>> episodios :', item['episodios'])
                print("\n=====================================================================================================\n")
            menu()
        elif valor == '2' :
            os.system('clear')
            nome = input('Digite o nome do anime :')
            genero = input('Digite o gênero do anime :')
            idade_indicativa = input('Digite o idade indicativa do anime :')
            episodios = input('Digite o preço do anime :')
            requests.post('http://localhost:8000/api/anime', data = {'name':nome, 'genero': genero, 'idade_indicativa':idade_indicativa,'episodios':episodios})
            menu()
        elif valor == '4':
            os.system('clear')
            print(" >> Use (1) Deletar Apenas Um anime")
            print(" >> Use (2) Para Deletar Todos os anime")
            print(" >> Use (0) Para Retornar ao Menu")
            resposta = input("Resposta :")
            if resposta == '1':
                animeId = input('Digite o Id do anime :')
                requests.delete('http://localhost:8000/api/anime/' + animeId)
            elif resposta == '2':
                requests.delete('http://localhost:8000/api/anime')
            else :
                menu()
        elif valor == '3':
            os.system('clear')
            identifier = input('Digite o ID do anime Que Você Deseja Alterar : ')
            nameN = input('Novo Nome : ')
            gen = input('Nova Gênero : ')
            idade_indicativaN = input('Nova Idade indicativa: ')
            episodiosN = input('Nova Preço: ')
            requests.put('http://localhost:8000/api/anime/' + identifier , data = {'id': identifier, 'name':nameN, 'genero': gen, 'idade_indicativa':idade_indicativaN,'episodios':episodiosN})
            menu()
        else :
            print("By by :)")
        #Percorrendo dados
menu(True)