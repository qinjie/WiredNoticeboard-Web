import pymysql
import os


_host = 'localhost'
_user = 'root'
_password = 'abcd1234'
_database = 'test'#'wired_noticeboard'
_dir_contain_file = r'/var/www/html/WiredNoticeboard-Web/uploads'

def get_filepaths(directory):
    file_paths = []  # List which will store all of the full filepaths.


    for root, directories, files in os.walk(directory):
        for filename in files:

            file_paths.append(filename)  # Add it to the list.

    return file_paths

def remove_file(filename) :
    os.remove(_dir_contain_file + '/' + filename)

if __name__ == '__main__' :
    print('Start')
    connection = pymysql.connect(host=_host,
                                 user=_user,
                                 password=_password,
                                 database=_database)
    cursor = connection.cursor()

    sql = 'SELECT * FROM media_file'
    cursor.execute(sql)
    result = cursor.fetchall()
   # print(result)
    list_file = get_filepaths(_dir_contain_file)
    cc = []
    for a in result :
        cc.append(a[6])

    for file in list_file :
        if file not in cc :
            remove_file(file)
            print('Delete ' + file )

    print('Finish')