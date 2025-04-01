import time
from googletrans import Translator
import asyncio

async def translate_chunk(translator, chunk, target_language='en'):
    """
    Asynchronously translates a single chunk of text.

    Args:
        translator (Translator): The googletrans Translator object.
        chunk (str): The text to translate.
        target_language (str): The target language code.

    Returns:
        str: The translated text.
    """
    try:
        translation = await translator.translate(chunk, dest=target_language)
        return translation.text
    except Exception as e:
        print(f"Translation error: {e}")
        return chunk  # Return original if translation fails

async def translate_text_chunks(text, target_language='en'):
    """
    Asynchronously translates text into a target language, handling long texts by splitting them into chunks.

    Args:
        text (str): The text to translate.
        target_language (str): The target language code.

    Returns:
        str: The translated text.
    """

    translator = Translator()
    max_chunk_size = 3500
    translated_chunks = []
    start = 0
    tasks = []

    while start < len(text):
        end = min(start + max_chunk_size, len(text))

        # Find the last space before the chunk limit to avoid splitting words
        if end < len(text):
            last_space = text.rfind(' ', start, end)
            if last_space != -1:
                end = last_space

        chunk = text[start:end]
        tasks.append(translate_chunk(translator, chunk, target_language))
        start = end + 1  # Move to the next chunk
        await asyncio.sleep(1)  # Pause to avoid rate limiting

    results = await asyncio.gather(*tasks)
    return ''.join(results)

async def main():
    text_to_translate = """
    This is a long text that needs to be translated. It will be split into smaller chunks to avoid exceeding the character limit of the translation service. This example is designed to test how the function handles word splitting at the end of each chunk, and ensures that no words are cut in half. The script also implements a short delay between translations to avoid rate limiting. Furthermore, the script handles potential errors during translation, returning the original text if the translation fails. This is a very long sentence that will be used to demonstrate how the script handles the translation of very long texts. It is important to consider the limitations of the translation service when handling such texts.
    """

    translated_text = await translate_text_chunks(text_to_translate)
    print(translated_text)

    text_to_translate_non_english = """
    Ceci est un long texte qui doit être traduit. Il sera divisé en petits morceaux pour éviter de dépasser la limite de caractères du service de traduction. Cet exemple est conçu pour tester comment la fonction gère la division des mots à la fin de chaque morceau et garantit qu'aucun mot n'est coupé en deux. Le script implémente également un court délai entre les traductions pour éviter la limitation de débit. De plus, le script gère les erreurs potentielles lors de la traduction, en renvoyant le texte original si la traduction échoue. C'est une très longue phrase qui servira à démontrer comment le script gère la traduction de textes très longs. Il est important de tenir compte des limites du service de traduction lors du traitement de tels textes.
    """

    translated_text_non_english = await translate_text_chunks(text_to_translate_non_english)
    print(translated_text_non_english)

if __name__ == "__main__":
    asyncio.run(main())