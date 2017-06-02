import parser as par
import preParser as pre
import generator as gen
import style 
#import os
#os.system("libreoffice --convert-to html Дозиметр\ Курск.docx")
name_file = "Новыйдокумент.html"



print("text = ",style.styleParser(pre.preParser(name_file)))

#space = par.parser(pre.preParser(name_file))
#space = parser(name_file)
'''
for w in range(1, len(space)+1):
	print(w, "> ", space[w])
'''
#gen.generator(space)
