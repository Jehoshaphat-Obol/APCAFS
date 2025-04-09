from sentence_transformers import SentenceTransformer
from nltk.tokenize import sent_tokenize, word_tokenize
import nltk
import asyncio

from translator.main import translate_text_chunks

nltk.data.path.append("/app/api/nltk_data")
nltk.download("punkt")
model = SentenceTransformer("/app/model/")

def chunk_text(text, max_words=100):
    sentences = sent_tokenize(text)
    chunks = []
    for sentence in sentences:
        words = word_tokenize(sentence)
        if len(words) > max_words:
            for i in range(0, len(words), max_words):
                chunk = " ".join(words[i:i+max_words])
                chunk = asyncio.run(translate_text_chunks(chunk))
                chunks.append(chunk)
        else:
            chunks.append(sentence)
    return chunks

def embed_chunks(chunks):
    return model.encode(chunks).tolist()
