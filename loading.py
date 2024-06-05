// load the saved model
$model = null;
$filename = "train.py";
if (file_exists($filename)) {
    $model = file_get_contents($filename);
    $model = unserialize($model);
}

// make predictions using the model
if ($model !== null) {
    $input_data = array(1.0, 2.0, 3.0, 4.0); // modify this to match your input data
    $predicted_class = $model->predict([ $input_data ]);
    echo "Predicted class: " . $predicted_class[0];
} else {
    echo "Failed to load model";
}
