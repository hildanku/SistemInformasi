#include <iostream>
#include <vector>
#include <algorithm>

struct Food {
    int foodId;
    std::string foodName;
    double foodTasteRating;
    double foodRiskRating;
    double foodAgeRating;
    double foodPriceRating;
    double foodDistanceRating;
};

struct Criteria {
    std::string criteriaCode;
    int criteriaWeight;
    std::string criteriaType;
};

int main() {
    // Data alternatif
    std::vector<Food> foods = {
        {1, "SEBLAK", 1.0, 2.0, 3.0, 1.0, 4.0},
        {2, "BAKSO BABI", 6.0, 5.0, 7.5, 6.0, 5.0},
        {3, "KUCING GORENG", 8.0, 3.0, 4.0, 7.0, 3.0}
    };

    // Data kriteria
    std::vector<Criteria> criterias = {
        {"taste", 30, "benefit"},
        {"risk", 20, "cost"},
        {"age", 25, "benefit"},
        {"price", 15, "cost"},
        {"distance", 10, "cost"}
    };

    // Hitung nilai normalisasi
    std::vector<std::map<std::string, double>> normalized_matrix;
    for (const auto& food : foods) {
        std::map<std::string, double> row;
        for (const auto& criteria : criterias) {
            // Ambil nilai atribut berdasarkan kode kriteria
            double value = 0.0;
            if (criteria.criteriaCode == "taste") {
                value = food.foodTasteRating;
            } else if (criteria.criteriaCode == "risk") {
                value = food.foodRiskRating;
            } else if (criteria.criteriaCode == "age") {
                value = food.foodAgeRating;
            } else if (criteria.criteriaCode == "price") {
                value = food.foodPriceRating;
            } else if (criteria.criteriaCode == "distance") {
                value = food.foodDistanceRating;
            }
            
            // Tentukan nilai maksimum atau minimum berdasarkan jenis kriteria
            if (criteria.criteriaType == "benefit") {
                double max_value = std::max_element(foods.begin(), foods.end(), [&](const Food& f1, const Food& f2) {
                    if (criteria.criteriaCode == "taste") {
                        return f1.foodTasteRating < f2.foodTasteRating;
                    } else if (criteria.criteriaCode == "risk") {
                        return f1.foodRiskRating < f2.foodRiskRating;
                    } else if (criteria.criteriaCode == "age") {
                        return f1.foodAgeRating < f2.foodAgeRating;
                    } else if (criteria.criteriaCode == "price") {
                        return f1.foodPriceRating < f2.foodPriceRating;
                    } else if (criteria.criteriaCode == "distance") {
                        return f1.foodDistanceRating < f2.foodDistanceRating;
                    }
                })->foodTasteRating;
                row[criteria.criteriaCode] = value / max_value;
            } else {
                double min_value = std::min_element(foods.begin(), foods.end(), [&](const Food& f1, const Food& f2) {
                    if (criteria.criteriaCode == "taste") {
                        return f1.foodTasteRating < f2.foodTasteRating;
                    } else if (criteria.criteriaCode == "risk") {
                        return f1.foodRiskRating < f2.foodRiskRating;
                    } else if (criteria.criteriaCode == "age") {
                        return f1.foodAgeRating < f2.foodAgeRating;
                    } else if (criteria.criteriaCode == "price") {
                        return f1.foodPriceRating < f2.foodPriceRating;
                    } else if (criteria.criteriaCode == "distance") {
                        return f1.foodDistanceRating < f2.foodDistanceRating;
                    }
                })->foodTasteRating;
                row[criteria.criteriaCode] = min_value / value;
            }
        }
        normalized_matrix.push_back(row);
    }

    // Hitung nilai preferensi (Vi)
    std::vector<double> weighted_sum;
    for (const auto& row : normalized_matrix) {
        double sum_value = 0.0;
        for (const auto& criteria : criterias) {
            sum_value += row.at(criteria.criteriaCode) * criteria.criteriaWeight;
        }
        weighted_sum.push_back(sum_value);
    }

    // Mendapatkan ranking alternatif berdasarkan nilai preferensi tertinggi
    std::vector<size_t> ranked_foods(weighted_sum.size());
    std::iota(ranked_foods.begin(), ranked_foods.end(), 0);
    std::sort(ranked_foods.begin(), ranked_foods.end(), [&](size_t i, size_t j) {
        return weighted_sum[i] > weighted_sum[j];
    });

    // Output hasil ranking
    std::cout << "Hasil ranking alternatif berdasarkan metode SAW:" << std::endl;
    for (size_t rank = 0; rank < ranked_foods.size(); ++rank) {
        const auto& food = foods[ranked_foods[rank]];
        std::cout << rank + 1 << ". " << food.foodName << " (Nilai Vi = " << weighted_sum[ranked_foods[rank]] << ")" << std::endl;
    }

    return 0;
}
