# recommend.py

import sys
from transformers import pipeline

# Safely handle command-line arguments
if len(sys.argv) < 2:
    print("No input provided")
    sys.exit(1)

text_input = sys.argv[1]

try:
    classifier = pipeline("zero-shot-classification", model="facebook/bart-large-mnli")

    labels = [
    "SEO",
    "Search Engine Marketing",
    "Social Media Marketing",
    "Content Creation",
    "Copywriting",
    "Email Marketing",
    "Affiliate Marketing",
    "Analytics",
    "Data Analysis",
    "E-commerce",
    "Product Management",
    "Influencer Marketing",
    "Video Marketing",
    "Brand Strategy",
    "Public Relations",
    "Market Research",
    "Growth Hacking",
    "UX/UI Design",
    "Advertising",
    "Digital Strategy"
]


    result = classifier(text_input, labels)

    top_label = result["labels"][0]
    print(top_label)
except Exception as e:
    print(f"Error: {e}")
    sys.exit(1)
