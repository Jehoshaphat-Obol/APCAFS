from django.test import TestCase
import joblib
import numpy as np


class ModelTestCase(TestCase):
    @classmethod
    def setUpTestData(cls):
        cls.model = joblib.load('./models/best_model_pipeline.pkl')
        
        cls.data = ["Is the concept of 'originality' an illusion? Are all ideas merely\
            recombinations of existing information, processed through unique\
            cognitive filters? #ideas #perception #INTPmusings supervert"]
        
    def test_model_resiliance_to_new_words(self):        
        prediction = self.model.predict(self.data)
        
        self.assertIsNotNone(prediction, "Returned and empty prediction")
        self.assertTrue(len(prediction) > 0, "Array is empty, no predictions were made")
        self.assertIsInstance(prediction, np.ndarray, "Prediction is not an instance of a numpy array")
