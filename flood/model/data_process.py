from datetime import datetime, timedelta
import mysql.connector
from numpy import array
import tensorflow
from sklearn import preprocessing
import pandas as pd
import numpy as np
from numpy.random import seed
from sklearn.preprocessing import MinMaxScaler

def split_sequence(sequence, n_steps):
	X, y = list(), list()
	for i in range(len(sequence)):
		# find the end of this pattern
		end_ix = i + n_steps
		# check if we are beyond the sequence
		if end_ix > len(sequence)-1:
			break
		# gather input and output parts of the pattern
		seq_x, seq_y = sequence[i:end_ix], sequence[end_ix]
		X.append(seq_x)
		y.append(seq_y)
	return array(X), array(y)

#database connection
servername = "localhost"
username = "root"
password = ""
database = "ncai_flood"

mydb = mysql.connector.connect(host=servername, user=username, passwd=password, database=database)
mycursor = mydb.cursor()

chk = 0

#Reading old data
# dataset = pd.read_excel('A:/Mehreen/Brooklyn_river.xlsx')
# dataset = dataset.dropna()
# dataset = dataset.values

while chk < 2:
	print("Loop: "+str(chk))
	# print(chk)
	# reading 20 old values from database
	old_data_sql = "SELECT level FROM `river_level2` where sent = 1 order by data_time desc limit 20"
	# print(old_data_sql)
	mycursor.execute(old_data_sql)
	# print(mycursor)
	result = mycursor.fetchall();
	dataset = []
	for i in result:
		dataset.append(i[0])

	# print(dataset)
	dataset = dataset[::-1]

	#fetching data from database
	data_from = "river_level2"
	query = "SELECT * FROM "+data_from+" where sent = 0 ORDER BY data_time ASC LIMIT 2"
	mycursor.execute(query)

	actual_time = ""
	predicted_time = ""
	to_predict_time = ""
	test_data_river_level = 0
	actual_river_level = 0
	flag = 0
	loc = ""

	for i in mycursor:
		loc = i[4]
		if(flag==0):
			test_data_river_level = i[2] 					#test input data
			test_data_time = i[1]							#test data date time
			predicted_time = i[1] + timedelta(hours=1)		#date time for which the value to be predicted
		else:
			to_predict_time = i[1]							#date time for which the value to be predicted
			actual_river_level = i[2]						#actual river level which will be predicted by model from test data

		flag = flag + 1

	flag = 0



	"#Reading real time data"

	# real_time_dataset = pd.read_excel('A:/Mehreen/Mernda-Hourly-River-Level.xlsx')
	# real_time_dataset = real_time_dataset.dropna()
	# real_time_dataset = real_time_dataset.values
	real_time_dataset = [0]
	real_time_dataset[0] = test_data_river_level

	"#combing both"

	combined_data = np.append(dataset, real_time_dataset)
	combined_data = combined_data.reshape(-1, 1)

	# "# normalize the dataset"
	# scaler = MinMaxScaler(feature_range=(0, 1))
	# size = len(combined_data)
	# x_train_norm = scaler.fit_transform(combined_data[0:size - 12])
	# x_test_norm = scaler.transform(combined_data[-12:, :])

	"#Arranging dataset in windows"
	n_steps = 6
	n_features = 1
	X, y = split_sequence(combined_data, n_steps)

	"#Reshaping in compatible format for LSTM"
	test = X.reshape((X.shape[0], X.shape[1], n_features))

	"#Loadng saved model"
	reconstructed_model = tensorflow.keras.models.load_model("A:/Mehreen/brooklyn 6 in 1 out")

	"#Making Predictions"
	yhat1 = reconstructed_model.predict(test, verbose=0)
	yhat = yhat1[-1]
	predicted_value  = yhat[0]
	# print("Input:")
	# print(test_data_river_level)
	# print("Predicted Value:")
	# print(yhat)
	# print("Actual Value:")
	# print(actual_river_level)
	#inserting prediction data to database
	insert_sql = "insert into river_level_prediction (location, test_input, predicted_time, predicted_level, actual_level) values ('"+loc+"',"+str(test_data_river_level)+",'"+str(to_predict_time)+"',"+str(predicted_value)+","+str(actual_river_level)+")"
	# print(insert_sql)
	# print(insert_sql)
	update_sql = "update river_level2 set sent = 1 where sent = 0 order by data_time asc limit 1"
	try:
		mycursor = mydb.cursor()
		mycursor.execute(insert_sql)
		mydb.commit()
		mycursor.execute(update_sql)
		mydb.commit()
		print("Data Inserted!")
	except:
		print ("Exception Occured")

	# else:
	# 	print("The values recieved from database were not consective hours")

	chk = chk + 1
