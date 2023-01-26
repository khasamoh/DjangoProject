from django.urls import path
from . import views

urlpatterns = [
    path('', views.index, name='index'),
    path('dashboard/', views.dashboard, name='dashboard'),
    path('product/', views.create, name='product'),
    path('customer/', views.insert_customer, name='customer'),
    path('users/', views.insert_user, name='users'),
    path('sales/', views.sales, name='sales'),
    path('salesummary/', views.salesummary, name='salesummary'),
    path('create/', views.create, name="create")
]