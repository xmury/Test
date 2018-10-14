# Авто добавление книжек на github
### Алгоритм:
- Перевести все книжки в html
- Сделать коммит с текущей датой
- Отправить инфу на github

```bash
mkdir -p /home/stepanyuk/VM4/html
mkdir -p /home/stepanyuk/VM3/html
mkdir -p /home/stepanyuk/Linux/html

for file in `find /home/xmury/test -type f -name "*.txt"`
do
	if [ `expr index $file "VM4"` != 0 ]
	then
		jupyter nbconvert --to html $file /home/stepanyuk/VM4/html/	
	fi

	if [ `expr index $file "VM3"` != 0 ]
	then
		jupyter nbconvert --to html $file /home/stepanyuk/VM3/html/	
	fi
done

date=`date`
cd /home/stepanyuk/
git add *
git commit -m "$date"
git push
   
```