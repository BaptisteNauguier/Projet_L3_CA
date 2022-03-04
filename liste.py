import mysql.connector


mybd = mysql.connector.connect(
    host="localhost",
    database="projet_ca",
    user="root",
    password="root" )


mycursor = mybd.cursor()
print(mycursor)

# recup variable nombre itération
mycursor.execute("SELECT count(id_commerce) FROM commerce_alimentaire")
nb_id = mycursor.fetchall()
nb = nb_id[0][0]


i=1

fichier = open("list.txt", "w", encoding="utf-8")
fichier.write("id;lien\n")

while i < nb:        #recup des id et liens maps
    mycursor.execute("SELECT id_commerce, nom_etablissement, coordonnee FROM commerce_alimentaire Where id_commerce="+str(i)+"")
    data = mycursor.fetchall()

    fichier.write(str(data[0][0])+";https://www.google.com/maps/place/"+str(data[0][1])+"/@"+str(data[0][2])+",15z\n")

    i+=1


print("Fin !")
fichier.close()
mybd.close()   