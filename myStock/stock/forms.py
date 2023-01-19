from django import forms
from .models import Product

class ProductForm(forms.ModelForm):
    productName = forms.CharField(required=True,widget=forms.TextInput(attrs={
        "class": "form-control",
        "placeholder": "productName"
    }))
    buyPrice= forms.CharField(required=True,widget=forms.TextInput(attrs={
        'type': "number",
        "class": "form-control",
        "placeholder": "buyPricee"
    }))
    
    salePrice = forms.CharField(required=True,widget=forms.TextInput(attrs={
        'type': "number",
        "class": "form-control",
        "placeholder": "salePrice"
    }))
    quantity = forms.CharField(required=True,widget=forms.TextInput(attrs={
        'type': "number",
        "class": "form-control",
        "placeholder": "quantity"
    }))
    '''
    class Meta:
        model = Product
        fields = [
            'productName', 'buyPrice','salePrice','quantity'
        ]
    '''
    class Meta:
        model = Product
        fields =('productName', 'buyPrice','salePrice','quantity')
