"""
Part of the IDCamp 2025 Challenge
Licensed under the MIT License
"""

from fastapi import FastAPI
from pydantic import BaseModel
import tensorflow as tf
import numpy as np
import joblib

from fastapi.middleware.cors import CORSMiddleware

app = FastAPI()

# SECURITY: Strict CORS Policy. Only allow the Laravel Backend to communicate via Browser if needed.
# Typically Laravel communicates server-to-server, but this prevents browser-based cross-origin attacks.
origins = [
    "http://localhost:8001",
    "http://127.0.0.1:8001",
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["GET", "POST"],
    allow_headers=["*"],
)
# 1. Load Model AI yang baru dan Scaler-nya
print("Memuat Otak AI dan Scaler...")
model = tf.keras.models.load_model('model_waspadalokal_asli.h5')
scaler = joblib.load('scaler_cuaca.pkl')

# 2. Format data dari Laravel
class DataCuaca(BaseModel):
    suhu: float
    kelembapan: float
    curah_hujan: float

@app.get("/")
def home():
    return {"message": "Mesin WaspadaLokal AI (Versi PRO) Menyala!"}

@app.post("/prediksi")
def prediksi_bencana(data: DataCuaca):
    # Susun input
    input_data = np.array([[data.suhu, data.kelembapan, data.curah_hujan]])
    
    # NORMALISASI: Ubah skala angka pakai aturan saat AI sekolah (Sangat Penting!)
    input_scaled = scaler.transform(input_data)
    
    # AI menebak berdasarkan data yang sudah distandarkan
    hasil = model.predict(input_scaled)
    kelas_risiko = np.argmax(hasil[0])
    
    label = {0: "Aman", 1: "Waspada Cuaca Buruk", 2: "Bahaya (Potensi Banjir Tinggi)"}
    
    return {
        "kode_risiko": int(kelas_risiko),
        "status": label[int(kelas_risiko)]
    }