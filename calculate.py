import sys
import json
import math

def calculate():
    try:
        float_a = float(sys.argv[1])
        float_b = float(sys.argv[2])
        float_c = float(sys.argv[3])
        
        # for Debug
        # float_a = 0
        # float_b = 1
        # float_c = 2
        
        s1 = float_c**3
        s2 = math.sqrt(s1)
        s3 = s2/float_a
        s4 = s3*10
        s5 = float_b+s4
        results = {
            "s1": s1,
            "s2": s2,
            "s3": s3,
            "s4": s4,
            "s5": s5
        }
        
        print(json.dumps(results))

        # for Debug
        # print("s1 is", s1)
        # print("s2 is", s2)
        # print("s3 is", s3)
        # print("s4 is", s4)
        # print("s5 is", s5)
        
    except Exception as e:
        print(json.dumps({"error": str(e)}))


if __name__ == "__main__":
    calculate()
    