import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier
import pickle

# load the dataset
df = pd.read_csv("train.csv")


# split the dataset into training and testing sets
X = df.drop('target_variable', axis=1)
y = df['target_variable']
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# train the model
model = DecisionTreeClassifier()
model.fit(X_train, y_train)

# save the model as a file
with open("manage.pkl", "wb") as f:
    pickle.dump(model, f)
